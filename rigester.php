<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ثبت نام در زیبوک</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;300;400;500;700&display=swap');
        
        * {
            font-family: 'Vazirmatn', sans-serif;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(to right, #f7d9e3,  #a475f9);
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        
        form {
            max-width: 700px;
            margin: 30px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            color: #a475f9;
            margin-bottom: 30px;
            font-weight: 700;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus {
            border-color: #a475f9;
            outline: none;
            box-shadow: 0 0 0 3px rgba(164, 117, 249, 0.2);
        }
        
        input[type="checkbox"] {
            margin-left: 8px;
            transform: scale(1.2);
        }
        
        .checkbox-group {
            margin: 20px 0;
            padding: 15px;
            background-color: #f7d9e3;
            border-radius: 10px;
        }
        
        .checkbox-group p {
            margin-top: 0;
            font-weight: 500;
            color: #a475f9;
        }
        
        input[type="submit"] {
            background-color: #a475f9;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            display: block;
            width: 100%;
            font-weight: 500;
        }
        
        input[type="submit"]:hover {
            background-color: #8e5af7;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        a {
            color: #a475f9;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        a:hover {
            color: #7d3af7;
            text-decoration: underline;
        }
        
        .file-input-container {
            margin-bottom: 20px;
        }
        
        .file-input-container p {
            margin-top: 5px;
            font-size: 14px;
        }
        
        .terms {
            background-color: #f7d9e3;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .required {
            color: red;
        }
        
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 15px;
            display: none;
        }
        
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        
        .image-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        
        .add-more-btn {
            background-color: #f7d9e3;
            color: #a475f9;
            border: 1px dashed #a475f9;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            margin-top: 10px;
            transition: all 0.3s;
        }
        
        .add-more-btn:hover {
            background-color: #e8c4d9;
        }
        
        @media (max-width: 768px) {
            form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <form action="" enctype="multipart/form-data">
        <h1>فرم ثبت نام در زیبوک</h1>
        
        <label for="username">نام سالن:</label>
        <input type="text" name="username" id="username" placeholder="نام سالن خود را وارد کنید" required>
        
        <label for="salonnumber">شماره تلفن سالن:</label>
        <input type="tel" name="salonnumber" id="salonnumber" placeholder="مثال: 09123456789" 
               pattern="[0-9]{11}" inputmode="numeric" required
               oninput="this.value = this.value.replace(/[^0-9]/g, '');">
        <p id="phone-error" class="error-message">لطفا شماره تلفن معتبر وارد کنید (11 رقم)</p>
        
        <label for="email">ایمیل:</label>
        <input type="email" name="email" id="email" placeholder="example@example.com" required>
        <p id="email-error" class="error-message">لطفا ایمیل معتبر وارد کنید</p>
        
        <label for="address">آدرس:</label>
        <input type="text" name="address" id="address" placeholder="آدرس کامل سالن را وارد کنید" required>
        
        <div class="checkbox-group" id="services-container">
            <p>خدمات خود را مشخص کنید: <span class="required">*</span></p>
        
            <label>
                <input type="checkbox" name="services[]" value="ناخن کاری" class="service-checkbox"> ناخن کاری
            </label>
        
            <label>
                <input type="checkbox" name="services[]" value="رنگ مو" class="service-checkbox"> رنگ مو
            </label>
        
            <label>
                <input type="checkbox" name="services[]" value="مژه" class="service-checkbox"> مژه
            </label>
        
            <label>
                <input type="checkbox" name="services[]" value="میکاپ" class="service-checkbox"> میکاپ
            </label>
            <p id="services-error" class="error-message">لطفا حداقل یک خدمت را انتخاب کنید</p>
        </div>
        
        <div class="file-input-container">
            <label>عکس‌های سالن (حداکثر 3 عکس):</label>
            <input type="file" name="images[]" id="images" accept="image/*" multiple 
                   onchange="previewImages(this)" style="display: none;">
            <label for="images" class="add-more-btn">+ افزودن عکس</label>
            <p style="color: red; font-size: 14px;">حداکثر حجم هر عکس: 1 مگابایت</p>
            <div class="image-preview-container" id="imagePreview"></div>
        </div>
        
        <div class="terms">
            <label>
                <input type="checkbox" name="agree" id="agree" required>
                من <a href="/test/rules.txt" target="_blank">قوانین سایت</a> را خوانده‌ام و قبول دارم.
            </label>
        </div>
        
        <input type="submit" value="ثبت نام">
    </form>

    <script>
        // اعتبارسنجی شماره تلفن
        const phoneInput = document.getElementById('salonnumber');
        const phoneError = document.getElementById('phone-error');
        
        phoneInput.addEventListener('input', function() {
            if (this.value.length !== 11 && this.value.length > 0) {
                phoneError.style.display = 'block';
            } else {
                phoneError.style.display = 'none';
            }
        });
        
        // اعتبارسنجی ایمیل
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        
        emailInput.addEventListener('blur', function() {
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (this.value && !emailRegex.test(this.value)) {
                emailError.style.display = 'block';
            } else {
                emailError.style.display = 'none';
            }
        });
        
        // اعتبارسنجی خدمات
        const form = document.querySelector('form');
        const serviceCheckboxes = document.querySelectorAll('.service-checkbox');
        const servicesError = document.getElementById('services-error');
        
        form.addEventListener('submit', function(e) {
            // اعتبارسنجی انتخاب خدمات
            let atLeastOneChecked = false;
            serviceCheckboxes.forEach(checkbox => {
                if (checkbox.checked) atLeastOneChecked = true;
            });
            
            if (!atLeastOneChecked) {
                e.preventDefault();
                servicesError.style.display = 'block';
                document.getElementById('services-container').scrollIntoView({
                    behavior: 'smooth'
                });
            }
            
            // اعتبارسنجی عکس‌ها
            const fileInput = document.getElementById('images');
            if (fileInput.files.length > 3) {
                e.preventDefault();
                alert('حداکثر می‌توانید 3 عکس آپلود کنید');
            }
        });
        
        // مخفی کردن خطای خدمات هنگام انتخاب
        serviceCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                let atLeastOneChecked = false;
                serviceCheckboxes.forEach(cb => {
                    if (cb.checked) atLeastOneChecked = true;
                });
                
                if (atLeastOneChecked) {
                    servicesError.style.display = 'none';
                }
            });
        });
        
        // پیش‌نمایش عکس‌ها
        function previewImages(input) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';
            
            if (input.files.length > 3) {
                alert('حداکثر می‌توانید 3 عکس انتخاب کنید');
                input.value = '';
                return;
            }
            
            for (let i = 0; i < Math.min(input.files.length, 3); i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('image-preview');
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    </script>

<script>
// آرایه برای ذخیره فایل‌های انتخاب شده
    let selectedFiles = [];

    function previewImages(input) {
        const previewContainer = document.getElementById('imagePreview');
    
    // بررسی تعداد فایل‌های انتخاب شده
        if (input.files.length + selectedFiles.length > 3) {
            alert('حداکثر می‌توانید 3 عکس انتخاب کنید');
            input.value = '';
            return;
        }

    // اضافه کردن فایل‌های جدید به آرایه
        for (let i = 0; i < input.files.length; i++) {
            selectedFiles.push(input.files[i]);
        }

    // نمایش تمام فایل‌ها
        previewContainer.innerHTML = '';
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.style.position = 'relative';
                imgContainer.style.display = 'inline-block';
            
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('image-preview');
            
                const removeBtn = document.createElement('span');
                removeBtn.innerHTML = '×';
                removeBtn.style.position = 'absolute';
                removeBtn.style.top = '0';
                removeBtn.style.left = '0';
                removeBtn.style.background = 'red';
                removeBtn.style.color = 'white';
                removeBtn.style.width = '20px';
                removeBtn.style.height = '20px';
                removeBtn.style.borderRadius = '50%';
                removeBtn.style.display = 'flex';
                removeBtn.style.justifyContent = 'center';
                removeBtn.style.alignItems = 'center';
                removeBtn.style.cursor = 'pointer';
                removeBtn.onclick = () => removeImage(index);
            
                imgContainer.appendChild(img);
                imgContainer.appendChild(removeBtn);
                previewContainer.appendChild(imgContainer);
            }
            reader.readAsDataURL(file);
        });

    // ریست کردن input فایل برای انتخاب مجدد
        input.value = '';
    }

    function removeImage(index) {
    // حذف فایل از آرایه
        selectedFiles.splice(index, 1);
    
    // نمایش مجدد فایل‌های باقیمانده
        const input = document.getElementById('images');
        previewImages(input);
    }

// قبل از ارسال فرم، فایل‌ها را به input فایل اضافه می‌کنیم
    document.querySelector('form').addEventListener('submit', function(e) {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });
        document.getElementById('images').files = dataTransfer.files;
    
        if (selectedFiles.length === 0) {
            e.preventDefault();
            alert('لطفا حداقل یک عکس انتخاب کنید');
        }
    });
</script>
</body>
</html>