# Laravel-Dasar

# Ringkasan Laravel — Cheat Sheet 🚀

---

## 1️⃣ Route Model Binding

**Fungsi:** Ambil data otomatis dari URL

```php
Route::get('/event/{event}', [EventController::class, 'show']);

public function show(Event $event)
```

**Yang terjadi:**

* Laravel otomatis cari `events.id = {event}`
* Kalau ketemu → lanjut
* Kalau tidak → **404 otomatis**

**Dipakai kapan?**

* Ambil 1 data (show, update, delete)

---

## 2️⃣ Form Request

**Fungsi:** Validasi request supaya controller bersih

```bash
php artisan make:request StoreEventRequest
```

```php
$request->validated();
```

**Keuntungan:**

* Validasi rapi
* Bisa reuse
* Controller lebih pendek

**Dipakai kapan?**

* Create / Update

---

## 3️⃣ Middleware

**Fungsi:** Filter request sebelum masuk controller

```php
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/event', ...);
});
```

**Contoh kegunaan:**

* Login / auth
* Role
* Rate limit

**Rule:**

> Middleware = "boleh masuk atau tidak"

---

## 4️⃣ Policy 🔥

**Fungsi:** Cek HAK AKSES ke data

```php
public function update(User $user, Event $event)
{
    return $user->id === $event->created_by;
}
```

Dipanggil di controller:

```php
$this->authorize('update', $event);
```

**Bedanya sama middleware?**

| Middleware | Policy          |
| ---------- | --------------- |
| Cek user   | Cek user + data |
| Global     | Spesifik model  |

---

## 5️⃣ Resource (API Resource)

**Fungsi:** Format JSON response

```php
return new EventResource($event);
```

**Kenapa perlu?**

* Sembunyiin field
* Rename field
* Konsisten

**Dipakai kapan?**

* API serius
* LKS

---

## 6️⃣ Exception Handling (Laravel 12)

**Fungsi:** Handle error secara global

Lokasi:

```php
bootstrap/app.php
```

Contoh:

```php
$exceptions->render(function (NotFoundHttpException $e, $request) {
    return response()->json(['message' => 'Not Found'], 404);
});
```

**Catatan penting:**

* Route Model Binding → `NotFoundHttpException`
* BUKAN `ModelNotFoundException`

---

## 7️⃣ Controller (Best Practice)

**Rule emas:**

> Controller = tipis

Isi ideal:

* Ambil request
* Panggil policy
* Return response

---

## 8️⃣ Alur Request Laravel (Gampang Diingat)

```
Client
 ↓
Middleware
 ↓
FormRequest (validasi)
 ↓
Controller
 ↓
Policy (izin)
 ↓
Model
 ↓
Resource
 ↓
Response JSON
```

---

## 9️⃣ Mana yang WAJIB vs OPSIONAL (LKS Mode)

### ✅ WAJIB PAKE

* Route Model Binding
* FormRequest
* Policy (update/delete)
* Resource

### ❌ BOLEH SKIP DULU

* Repository Pattern
* Service Class
* Event Listener

---

## 🔑 Kalimat Sakti (Kalau Lupa)

* **Middleware:** boleh masuk?
* **Policy:** boleh ngapain?
* **FormRequest:** data valid?
* **Resource:** response rapi?
* **Exception:** error konsisten?

---

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
