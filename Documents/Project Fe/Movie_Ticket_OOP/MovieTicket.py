class Movie:
    def __init__(self, title, duration, price):
        self.title = title
        self.duration = duration
        self.price = price

    def __str__(self):
        return f"{self.title} ({self.duration} mins) - ₱{self.price} per ticket"


class Showtime:
    def __init__(self, movie, time, available_seats):
        self.movie = movie
        self.time = time
        self.available_seats = available_seats

    def book_seats(self, num_tickets):
        if num_tickets <= self.available_seats:
            self.available_seats -= num_tickets
            return True
        return False

    def __str__(self):
        return f"{self.movie.title} - {self.time} | Seats Available: {self.available_seats}"


class Ticket:
    def __init__(self, movie, time, num_tickets):
        self.movie = movie
        self.time = time
        self.num_tickets = num_tickets
        self.total_cost = movie.price * num_tickets

    def __str__(self):
        return (f"Movie: {self.movie.title}\n"
                f"Showtime: {self.time}\n"
                f"Tickets: {self.num_tickets}\n"
                f"Total: ₱{self.total_cost}\n")


class BookingSystem:
    def __init__(self):
        self.movies = []
        self.showtimes = []
        self.bookings = []

    def add_movie(self, movie):
        self.movies.append(movie)

    def add_showtime(self, showtime):
        self.showtimes.append(showtime)

    def display_showtimes(self):
        print("\nAvailable Showtimes:")
        for i, showtime in enumerate(self.showtimes, 1):
            print(f"{i}. {showtime}")

    def book_ticket(self):
        self.display_showtimes()

        # ------- SAFE SHOWTIME CHOICE -------
        try:
            choice = int(input("\nSelect a showtime: ")) - 1
            if choice < 0 or choice >= len(self.showtimes):
                print("Invalid showtime number. Please try again.")
                return
        except ValueError:
            print("Please enter a valid number.")
            return

        showtime = self.showtimes[choice]
        print(f"\nYou selected: {showtime.movie.title} - {showtime.time}")

        # ------- SAFE TICKET INPUT -------
        try:
            num_tickets = int(input("Enter number of tickets: "))
            if num_tickets <= 0:
                print("Number of tickets must be greater than 0.")
                return
        except ValueError:
            print("Please enter a valid number.")
            return

        # ------- BOOKING CHECK -------
        if showtime.book_seats(num_tickets):
            ticket = Ticket(showtime.movie, showtime.time, num_tickets)
            self.bookings.append(ticket)
            print("\nBooking Successful!")
            print(ticket)
        else:
            print("\nSorry, not enough seats available.")


if __name__ == "__main__":
    system = BookingSystem()

    movie1 = Movie("Madagascar", 120, 250)
    movie2 = Movie("Frozen", 140, 300)

    system.add_movie(movie1)
    system.add_movie(movie2)

    system.add_showtime(Showtime(movie1, "1:00 PM", 50))
    system.add_showtime(Showtime(movie1, "4:00 PM", 40))
    system.add_showtime(Showtime(movie2, "2:30 PM", 30))
    system.add_showtime(Showtime(movie2, "6:00 PM", 25))

    while True:
        print("\n--- Welcome to CineVerse Booking System ---")
        print("1. View Showtimes")
        print("2. Book Ticket")
        print("3. Exit")

        choice = input("Enter choice: ")

        if choice == "1":
            system.display_showtimes()
        elif choice == "2":
            system.book_ticket()
        elif choice == "3":
            print("Thank you for using CineVerse! Goodbye.")
            break
        else:
            print("Invalid choice. Try again.")
