SIAP 😄
Kalau kemarin kamu sudah **Event – Ticket – Booking – Check-in**, kita naik level ya. Ini **latihan yang mirip LKS tapi lebih “jahat”** 🔥

---

## 🚀 CASE ADVANCED: EVENT TICKET SYSTEM (LEVEL LKS++)

### 🧠 Konsep baru yang dilatih

Latihan ini **bukan cuma CRUD**, tapi:

* Relasi kompleks
* Validasi bisnis
* Transaction
* Authorization (Policy)
* Query advance
* Status flow (state machine ringan)

---

## 🧩 STUDI KASUS

### 📌 Fitur Utama

1. **Event**
2. **Ticket Type** (VIP, Regular, dll)
3. **Booking**
4. **Check-in**
5. **Refund**
6. **Quota & Time Constraint**

---

## 🗂️ STRUKTUR TABLE

### 1️⃣ events

| field      | type     |
| ---------- | -------- |
| id         | bigint   |
| title      | string   |
| start_time | datetime |
| end_time   | datetime |
| created_by | user_id  |
| is_active  | boolean  |

---

### 2️⃣ tickets

| field    | type    |
| -------- | ------- |
| id       | bigint  |
| event_id | fk      |
| name     | string  |
| price    | integer |
| quota    | integer |

---

### 3️⃣ bookings

| field     | type                                                       |
| --------- | ---------------------------------------------------------- |
| id        | bigint                                                     |
| user_id   | fk                                                         |
| ticket_id | fk                                                         |
| status    | enum(`pending`,`paid`,`checked_in`,`cancelled`,`refunded`) |
| booked_at | datetime                                                   |

⚠️ **RULE:**
`user_id + ticket_id` **HARUS UNIQUE**

---

### 4️⃣ checkins

| field         | type     |
| ------------- | -------- |
| id            | bigint   |
| booking_id    | fk       |
| checked_in_at | datetime |
| officer_id    | user_id  |

---

### 5️⃣ refunds

| field       | type     |
| ----------- | -------- |
| id          | bigint   |
| booking_id  | fk       |
| reason      | text     |
| refunded_at | datetime |

---

## 🔥 CHALLENGE LOGIC (INI YANG SUSAH)

---

### 1️⃣ BOOKING TICKET

Endpoint:

```
POST /api/events/{event}/tickets/{ticket}/book
```

#### Rules:

* ❌ Event sudah selesai → reject
* ❌ Ticket quota habis → reject
* ❌ User sudah booking ticket itu → reject
* ✅ Jika sukses:

  * buat booking status `paid`
  * kurangi quota ticket
  * pakai **DB::transaction()**

---

### 2️⃣ CHECK-IN TICKET

Endpoint:

```
POST /api/bookings/{booking}/checkin
```

#### Rules:

* ❌ booking bukan milik event hari ini
* ❌ status ≠ `paid`
* ❌ sudah check-in
* ✅ jika sukses:

  * status → `checked_in`
  * insert ke table `checkins`

---

### 3️⃣ REFUND TICKET

Endpoint:

```
POST /api/bookings/{booking}/refund
```

#### Rules:

* ❌ sudah check-in → tidak bisa refund
* ❌ event sudah mulai → tidak bisa refund
* ✅ refund:

  * status → `refunded`
  * quota ticket +1
  * simpan reason

---

### 4️⃣ AUTHORIZATION (POLICY)

| Aksi         | Siapa   |
| ------------ | ------- |
| Create Event | Admin   |
| Check-in     | Officer |
| Refund       | Admin   |
| Booking      | User    |

👉 **WAJIB pakai Policy**, bukan if biasa

---

### 5️⃣ QUERY LEVEL LKS

Buat endpoint:

```
GET /api/events/{event}/summary
```

Response:

```json
{
  "total_ticket": 300,
  "total_booking": 250,
  "total_checked_in": 180,
  "total_refunded": 20,
  "income": 12500000
}
```

⚠️ **Hint:**

* `withCount`
* `sum`
* join bookings + tickets

---

## 🧪 BONUS (KALAU MAU NAIK LEVEL DEWA 😈)

* Soft delete booking → tapi quota tetap balik
* Middleware `event.active`
* Booking auto expired kalau `paid` > 30 menit (scheduler)
* Resource API + pagination
* Error code pakai HTTP status yang benar

---

## 🎯 TARGET KAMU

Kalau kamu bisa:

* desain migration
* controller logic clean
* pakai transaction + policy
* query summary benar

👉 **itu udah SETARA LKS PROVINSI 🔥**

---

Kalau mau, bilang:

* 👉 **“Bang, breakdown step by step”**
* 👉 **“Bang, kasih ERD dulu”**
* 👉 **“Bang, gue mau langsung disuruh bikin controller doang”**

Aku gasin sesuai gaya belajar kamu 😎
