def Inventory():
    Items = []
    Item_price = {}

    print("====INVENTORY MENU====")
    print("[1] Add Item")
    print("[2] Update Item Price")
    print("[3] Exit\n")

    while True:
        try:
            input_choice = int(input("Choose an option: "))

            if input_choice == 1:

                item_name = input("Enter item name: ")

                if not item_name.strip():
                    print("Item name cannot be empty.\n")
                    continue
                
                if item_name in Items:
                    print(f"Item {item_name} already exists in inventory.\n")
                    continue

                try:
                    item_price = float(input("Enter item price: "))

                    if item_price < 0:
                        print("Price cannot be negative.\n")
                        continue
                    Items.append(item_name)
                    Item_price[item_name] = item_price

                    print(f"Item added sucessfully\n")
                except ValueError:
                    print("Invalid price. Please enter a numeric value.\n")
                    continue
            
            elif input_choice == 2:
                item_name = input("Enter item name to update price: ")

                if item_name not in Items:
                    print(f"Item {item_name} does not exist in inventory.\n")
                    continue

                try:
                    new_price = float(input("Enter new item price: "))

                    if (new_price < 0):
                        print("Price cannot be negative.\n")
                        continue

                    Item_price[item_name] = new_price
                    print(f"Item {item_name} price updated to {new_price}.\n")
                except ValueError:
                    print("Invalid price. Please enter a numeric value.\n")
                    continue
            elif input_choice == 3:
                print("Exiting Inventory Menu.")
                break
        except Exception as e:
            print(f"An error occurred: {e}. Please try again\n")
                    

if __name__ == "__main__":
    Inventory()