---

# 🏆 LATIHAN LKS – LEVEL 2 (MENENGAH → SULIT)

## 📌 STUDI KASUS

*Sistem Event + Ticket + Booking + Check-in*

> 1 Event
> 1 Event punya banyak Ticket Type
> User bisa booking Ticket
> Ticket punya quota
> User bisa check-in (1x)

---

## 🧱 STRUKTUR DATABASE (4 TABLE 🔥)

### 1️⃣ events

| field      | type     |
| ---------- | -------- |
| id         | bigint   |
| title      | string   |
| event_date | date     |
| created_by | fk users |

---

### 2️⃣ tickets

| field    | type                  |
| -------- | --------------------- |
| id       | bigint                |
| event_id | fk events             |
| name     | string (VIP, Reguler) |
| price    | integer               |
| quota    | integer               |

---

### 3️⃣ bookings

| field     | type                        |
| --------- | --------------------------- |
| id        | bigint                      |
| user_id   | fk users                    |
| ticket_id | fk tickets                  |
| status    | enum(booked,checked_in) |
| booked_at | datetime                    |

👉 *UNIQUE(user_id, ticket_id)*

---

### 4️⃣ checkins

| field         | type        |
| ------------- | ----------- |
| id            | bigint      |
| booking_id    | fk bookings |
| checked_in_at | datetime    |

👉 *UNIQUE(booking_id)*

---

# 🧠 ATURAN BISNIS (INI YANG BIKIN SULIT)

1️⃣ User *tidak boleh booking ticket yg sama 2x*
2️⃣ Booking *ditolak kalau quota ticket habis*
3️⃣ Check-in *hanya boleh sekali*
4️⃣ User *hanya boleh check-in booking miliknya*
5️⃣ Admin bisa lihat semua booking
6️⃣ User hanya bisa lihat booking miliknya

---

# 🔥 TUGAS KAMU (KERJAIN SATU-SATU)

---

## 🟢 PART 1 — ROUTE DESIGN (WAJIB)

Bikin API route:

* list event + ticket
* booking ticket
* my bookings
* check-in booking

❗ pakai:

* auth:sanctum
* policy (ownership)

---

## 🟡 PART 2 — BOOKING LOGIC (INTI LKS)

Ketika user booking ticket:

❗ Wajib cek:

* ticket ada
* quota > 0
* belum pernah booking ticket tsb

👉 *HARUS ATOMIC (TRANSACTION)*

---

## 🔴 PART 3 — CHECK-IN (JEBEKN JURI)

Endpoint:


POST /bookings/{booking}/checkin


Aturan:

* booking milik user
* status belum checked_in
* bikin record checkins
* update status booking

---

## 🟣 PART 4 — POLICY (INI YANG DINILAI)

Bikin policy:

### BookingPolicy

* view
* checkin

---

# 🧑‍⚖️ CARA PENILAIAN JURI

| Aspek            | Nilai |
| ---------------- | ----- |
| Logic benar      | ⭐⭐⭐⭐  |
| Keamanan         | ⭐⭐⭐⭐  |
| Code rapi        | ⭐⭐⭐   |
| Over-engineering | ❌     |

---

# 🚨 CATATAN PENTING

❌ jangan pakai exception custom
❌ jangan bikin service berlapis
❌ jangan ribet
✅ fokus *jalan & aman*

---

# 🎯 TARGET KAMU

Kalau kamu bisa:

* jelasin alur booking
* jelasin kenapa pakai transaction
* jelasin kenapa pakai policy

👉 *AUTO DIANGGAP KUAT BACKEND*

---
