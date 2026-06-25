import hashlib


SHIFT = 3


def caesar_encrypt(text, shift):
    encrypted_text = []

    for char in text:
        if char.isalpha():
            base = ord("A") if char.isupper() else ord("a")
            shifted_char = chr((ord(char) - base + shift) % 26 + base)
            encrypted_text.append(shifted_char)
        else:
            encrypted_text.append(char)

    return "".join(encrypted_text)


def caesar_decrypt(text, shift):
    return caesar_encrypt(text, -shift)


def main():
    word = input("Enter a word: ")

    md5_hash = hashlib.md5(word.encode()).hexdigest()
    encrypted_word = caesar_encrypt(word, SHIFT)
    decrypted_word = caesar_decrypt(encrypted_word, SHIFT)

    print(f"MD5 Hash: {md5_hash}")
    print(f"Encrypted Word: {encrypted_word}")
    print(f"Decrypted Word: {decrypted_word}")


if __name__ == "__main__":
    main()
