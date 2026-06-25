<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Category;
use App\Models\Transaction;
use App\Services\AchievementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function __construct(
        private readonly AchievementService $achievementService
    ) {}

    public function index(Request $request): Response
    {
        $query = Transaction::where('user_id', auth()->id())
            ->with('category')
            ->latest();

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($type = $request->input('type')) {
            $query->where('type', $type);
        }

        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        if ($month = $request->input('month')) {
            $query->whereMonth('transaction_date', date('m', strtotime($month)))
                ->whereYear('transaction_date', date('Y', strtotime($month)));
        }

        $transactions = $query->paginate(15)->withQueryString();

        $categories = Category::where('user_id', auth()->id())->get();

        return Inertia::render('Transactions/Index', [
            'transactions' => $transactions,
            'categories' => $categories,
            'filters' => $request->only(['search', 'type', 'category_id', 'month']),
        ]);
    }

    public function create(): Response
    {
        $categories = Category::where('user_id', auth()->id())->get();

        return Inertia::render('Transactions/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(StoreTransactionRequest $request): RedirectResponse
    {
        Transaction::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'amount' => $request->amount,
            'type' => $request->type,
            'transaction_date' => $request->transaction_date,
            'notes' => $request->notes,
        ]);

        $user = auth()->user();
        $xpAmount = $request->type === 'income' ? 15 : 10;
        $xp = $this->achievementService->awardXp($user, $xpAmount, 'Transaction recorded');
        $newAchievements = $this->achievementService->checkAchievements($user);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction created successfully.')
            ->with('xp', $xp)
            ->with('new_achievements', $newAchievements);
    }

    public function edit(Transaction $transaction): Response
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $categories = Category::where('user_id', auth()->id())->get();

        return Inertia::render('Transactions/Edit', [
            'transaction' => $transaction->load('category'),
            'categories' => $categories,
        ]);
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction): RedirectResponse
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->update($request->validated());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction): RedirectResponse
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
}
