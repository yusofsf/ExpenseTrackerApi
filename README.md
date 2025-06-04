<div dir="rtl">


###  مدیریت هزینه ها و مخارج - ExpenseTrackerApi

---

###  ویژگی‌های پروژه سفارش آنلاین غذا

#### افزدون تراکنش
اضافه کردن هزینه یا درآمد با عنوان، مبلغ، دسته‌بندی، تاریخ، توضیحات و نوع (درآمد یا هزینه).

#### دسته‌بندی تراکنش‌ ها
مانند: غذا، حمل‌ونقل، اجاره، تفریح، پزشکی، حقوق، هدیه و...

#### فیلتر و جستجو
فیلتر تراکنش‌ها براساس تاریخ، دسته، مبلغ و جستجوی متنی.

#### گزارش‌گیری
خروجی PDF از تراکنش‌ها، گزارش ماهانه یا سالانه.

---

###  نصب و راه‌اندازی

#### 1. پروژه را clone کنید
```bash
git clone https://github.com/yusofsf/ExpenseTrackerApi.git
cd DeliciousFood
```

#### 1.2 نصب وابستگی ها
```bash
composer install
npm install
```

#### 2.2 تولید key و فایل env.
```bash
cp .env.example .env 
php artisan key:generate
```

#### 3.2 اجرای migrate و seed DB
```bash
php artisan migrate --seed
```
#### 4.2 اجرای پروژه
```bash
npm run dev
php artisan serve
```
---
---
#### ساختار کلی پروژه


</div>


```
app/
├── Http/
│   ├── Controllers/
│       ├── Api/
│   ├── Requests/
├── Interfaces/
├── Models/
├── Providers/
├── Services/
```
---
<div dir="rtl">


این پروژه توسط [yusofsf](https://github.com/yusofsf) توسعه داده شده است.

</div>
