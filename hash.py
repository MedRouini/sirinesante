import hashlib

def hash_password(password):
    # Choisissez un algorithme de hachage sécurisé, par exemple SHA-256
    hasher = hashlib.sha256()
    # Encodez le mot de passe en UTF-8 avant de le hacher
    hasher.update(password.encode('utf-8'))
    # Renvoie le hachage hexadécimal du mot de passe
    return hasher.hexdigest()

# Exemple d'utilisation de la fonction hash_password
password = "0"
hashed_password = hash_password(password)
print("Mot de passe haché :", hashed_password)
