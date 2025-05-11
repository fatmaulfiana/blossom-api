# Blossom API 🌸 

API sederhana untuk mengelola pengguna, produk, keranjang belanja, wishlist, pesanan, dan alamat.

---

## 📌 Base URL
http://localhost:8000/api


---

## 📂 Endpoints

### 🔹 Users
- **Lihat semua pengguna:** `GET /users`
- **Lihat satu pengguna:** `GET /users/{id}`
- **Tambah pengguna:** `POST /users`
- **Ubah pengguna:** `PUT /users/{id}`
- **Hapus pengguna:** `DELETE /users/{id}`

---

### 🔹 Products
- **Lihat semua produk:** `GET /products`
- **Lihat satu produk:** `GET /products/{id}`
- **Tambah produk:** `POST /products`
- **Ubah produk:** `PUT /products/{id}`
- **Hapus produk:** `DELETE /products/{id}`

---

### 🔹 Carts (Keranjang)
- **Lihat keranjang user:** `GET /carts/{user_id}`
- **Tambah ke keranjang:** `POST /carts`
- **Ubah item keranjang:** `PUT /carts/{id}`
- **Hapus dari keranjang:** `DELETE /carts/{id}`

---

### 🔹 Wishlist
- **Lihat wishlist user:** `GET /wishlist/{user_id}`
- **Tambah ke wishlist:** `POST /wishlist`

---

### 🔹 Booked (Pesanan)
- **Lihat pesanan user:** `GET /booked/{user_id}`
- **Tambah pesanan:** `POST /booked`

---

### 🔹 Address
- **Lihat alamat user:** `GET /addresses/{user_id}`
- **Tambah alamat:** `POST /addresses`

---

## ✅ Format Request

Gunakan **JSON** di body request, contohnya:

```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "secret"
}

❗ Error Response
{
  "error": {
    "field": [
      "Pesan kesalahan"
    ]
  }
}
