# Laravel-Dasar


# Status Response
---

## ✅ 2xx — **Request BERHASIL**

Dipakai kalau request user **sukses**

### **200 OK**

➡️ Request berhasil (paling sering)

* Get data
* Update data
* Delete data (kadang)

**Contoh:**

```json
{
  "message": "Data berhasil diambil"
}
```

---

### **201 Created**

➡️ Data **berhasil dibuat**

* Register user
* Create event
* Create course

**Contoh:**

```json
{
  "message": "Event berhasil dibuat"
}
```

📌 **Catatan LKS**
👉 `POST /create` = **201**, bukan 200

---

### **204 No Content**

➡️ Berhasil tapi **ga ada response body**

* Delete data (best practice)

**Contoh:**

```http
204 No Content
```

---

## ⚠️ 4xx — **KESALAHAN DARI USER**

User salah kirim data / ga punya akses

---

### **400 Bad Request**

➡️ Request tidak valid (format salah)

**Kasus:**

* Field kosong
* Tipe data salah

---

### **401 Unauthorized**

➡️ Belum login / token salah

**Kasus:**

* Akses API tanpa login
* Token expired

📌 **Auth Sanctum / JWT sering banget pake ini**

---

### **403 Forbidden**

➡️ Sudah login tapi **GA BOLEH akses**

**Kasus LKS klasik:**

* User role `user` akses fitur `admin`
* Admin lain edit data bukan miliknya

👉 **INI YANG PALING SERING KETUKER SAMA 401**

```php
return response()->json([
  'message' => 'Anda tidak memiliki akses'
], 403);
```

---

### **404 Not Found**

➡️ Data tidak ditemukan

**Kasus:**

* ID tidak ada
* Event sudah dihapus

---

### **409 Conflict**

➡️ Data bentrok / duplikat

🔥 **INI STATUS FAVORIT JURI LKS**

**Kasus:**

* User daftar course dua kali
* Email sudah terdaftar

```json
{
  "message": "User sudah terdaftar di event ini"
}
```

---

### **422 Unprocessable Entity**

➡️ Validasi gagal (Laravel favorit 💙)

**Kasus:**

* Email ga valid
* Password kurang panjang

📌 **FormRequest otomatis pake 422**

---

## 💥 5xx — **KESALAHAN SERVER**

Biasanya **bukan salah user**

---

### **500 Internal Server Error**

➡️ Error di backend

**Kasus:**

* Logic salah
* Query error
* Bug kode

📌 **Kalau ini muncul di LKS = BAD SIGN** 😬
Harusnya error bisa dicegah

---

## 🧠 RINGKASAN HAFAL CEPAT (WAJIB HAFAL)

| Status | Arti Singkat         |
| ------ | -------------------- |
| 200    | Berhasil             |
| 201    | Data dibuat          |
| 204    | Berhasil, no content |
| 400    | Request salah        |
| 401    | Belum login          |
| 403    | Ga punya akses       |
| 404    | Data tidak ada       |
| 409    | Data duplikat        |
| 422    | Validasi gagal       |
| 500    | Server error         |

---

## 🎯 POLA YANG SERING DIPAKE DI LKS

**CREATE**

* sukses → `201`
* validasi gagal → `422`
* duplikat → `409`
* role salah → `403`

**GET**

* sukses → `200`
* data kosong → `404`

**UPDATE**

* sukses → `200`
* bukan pemilik → `403`

**DELETE**

* sukses → `204`
* data ga ada → `404`

---
