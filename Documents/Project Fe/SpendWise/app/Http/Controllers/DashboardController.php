<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\AchievementService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __construct(
        private readonly AchievementService $achievementService
    ) {}

    public function index(): Response
    {
        $userId = auth()->id();
        $user = auth()->user();

        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->sum('amount');

        $totalExpenses = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->sum('amount');

        $balance = $totalIncome - $totalExpenses;

        $thisMonthExpenses = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->sum('amount');

        $expensesByCategory = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->with('category')
            ->get();

        $monthlyOverview = Transaction::where('user_id', $userId)
            ->selectRaw("DATE_FORMAT(transaction_date, '%Y-%m') as month")
            ->selectRaw("SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as income")
            ->selectRaw("SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as expense")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $gamification = $this->achievementService->getDashboardData($user);

        return Inertia::render('Dashboard', [
            'totalIncome' => (float) $totalIncome,
            'totalExpenses' => (float) $totalExpenses,
            'balance' => (float) $balance,
            'thisMonthExpenses' => (float) $thisMonthExpenses,
            'expensesByCategory' => $expensesByCategory,
            'monthlyOverview' => $monthlyOverview,
            'gamification' => $gamification,
        ]);
    }

    public function monthly(Request $request): Response
    {
        $userId = auth()->id();
        $year = $request->input('year', now()->year);

        $months = Transaction::where('user_id', $userId)
            ->whereYear('transaction_date', $year)
            ->selectRaw("MONTH(transaction_date) as month")
            ->selectRaw("SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as income")
            ->selectRaw("SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as expense")
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $topCategory = \App\Models\Category::where('user_id', $userId)
            ->where('type', 'expense')
            ->withSum(['transactions' => function ($q) use ($year) {
                $q->whereYear('transaction_date', $year);
            }], 'amount')
            ->orderByDesc('transactions_sum_amount')
            ->first();

        $totals = [
            'income' => $months->sum('income'),
            'expense' => $months->sum('expense'),
            'balance' => $months->sum('income') - $months->sum('expense'),
        ];

        return Inertia::render('Reports/Monthly', [
            'months' => $months,
            'totals' => $totals,
            'topCategory' => $topCategory,
            'year' => $year,
        ]);
    }
}
