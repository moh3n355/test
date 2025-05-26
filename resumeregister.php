<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت خدمات - زیبوک</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;300;400;500;700&display=swap');
        
        * {
            font-family: 'Vazirmatn', sans-serif;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(to right, #f7d9e3, #a475f9);
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        
        .form-container {
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
        input[type="number"],
        select {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #a475f9;
            outline: none;
            box-shadow: 0 0 0 3px rgba(164, 117, 249, 0.2);
        }
        
        button, input[type="submit"] {
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
            margin-top: 10px;
        }
        
        button:hover, input[type="submit"]:hover {
            background-color: #8e5af7;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .service-item {
            background-color: #f7d9e3;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }
        
        .service-item:hover {
            transform: translateX(-5px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        
        .service-info {
            flex: 1;
        }
        
        .service-name {
            font-weight: 700;
            color: #555;
            margin-bottom: 5px;
        }
        
        .service-details {
            display: flex;
            gap: 15px;
            font-size: 14px;
        }
        
        .service-price {
            color: #a475f9;
            font-weight: bold;
        }
        
        .service-duration {
            color: #666;
        }
        
        .remove-service {
            color: red;
            cursor: pointer;
            font-size: 20px;
            padding: 0 10px;
            transition: all 0.3s;
        }
        
        .remove-service:hover {
            transform: scale(1.2);
        }
        
        .empty-message {
            text-align: center;
            color: #888;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>مدیریت خدمات و تعرفه‌ها</h1>
        
        <form id="serviceForm">
            <label for="serviceName">نام سرویس:</label>
            <input type="text" id="serviceName" placeholder="مثال: ناخن کاری، رنگ مو، میکاپ" required>
            
            <label for="servicePrice">هزینه سرویس (تومان):</label>
            <input type="number" id="servicePrice" placeholder="مثال: 150000" required>
            
            <label for="serviceDuration">مدت زمان انجام هزینه (دقیقه):</label>
            <input type="number" id="serviceDuration" placeholder="مثال: 60" required>
            
            <button type="submit">افزودن سرویس جدید</button>
        </form>
        
        <div id="servicesList">
            <h2 style="color: #a475f9; margin-top: 30px; border-bottom: 2px solid #f7d9e3; padding-bottom: 10px;">
                لیست خدمات تعریف شده
            </h2>
            <div id="servicesContainer"></div>
        </div>

        <!-- دکمه ثبت نهایی خدمات -->
        <button id="submitFinal" disabled>ثبت نهایی خدمات</button>
    </div>

    <script>
        const serviceForm = document.getElementById('serviceForm');
        const servicesContainer = document.getElementById('servicesContainer');
        const submitFinalBtn = document.getElementById('submitFinal');
        let services = JSON.parse(localStorage.getItem('zibook-services')) || [];

        // بارگذاری اولیه خدمات
        document.addEventListener('DOMContentLoaded', loadServices);

        function loadServices() {
            updateServicesDisplay();
        }

        serviceForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const serviceName = document.getElementById('serviceName').value.trim();
            const servicePrice = document.getElementById('servicePrice').value;
            const serviceDuration = document.getElementById('serviceDuration').value;

            if (!serviceName || !servicePrice || !serviceDuration) {
                alert('لطفا تمام فیلدها را پر کنید');
                return;
            }

            const service = {
                id: Date.now(),
                name: serviceName,
                price: servicePrice,
                duration: serviceDuration,
                createdAt: new Date().toLocaleString('fa-IR')
            };

            services.push(service);
            saveServices();
            updateServicesDisplay();

            serviceForm.reset();
            document.getElementById('serviceName').focus();
        });

        function updateServicesDisplay() {
            servicesContainer.innerHTML = '';

            if (services.length === 0) {
                servicesContainer.innerHTML = `
                    <div class="empty-message">
                        هنوز سرویس اضافه نشده است. اولین سرویس را اضافه کنید.
                    </div>
                `;
            } else {
                services.forEach((service, index) => {
                    const serviceItem = document.createElement('div');
                    serviceItem.className = 'service-item';
                    serviceItem.innerHTML = `
                        <div class="service-info">
                            <div class="service-name">${service.name}</div>
                            <div class="service-details">
                                <span class="service-price">${Number(service.price).toLocaleString('fa-IR')} تومان</span>
                                <span class="service-duration">${service.duration} دقیقه</span>
                            </div>
                        </div>
                        <span class="remove-service" onclick="removeService(${index})">×</span>
                    `;
                    servicesContainer.appendChild(serviceItem);
                });
            }

            updateSubmitButtonStatus();
        }

        function removeService(index) {
            if (confirm(`آیا از حذف سرویس "${services[index].name}" مطمئن هستید؟`)) {
                services.splice(index, 1);
                saveServices();
                updateServicesDisplay();
            }
        }

        function saveServices() {
            localStorage.setItem('zibook-services', JSON.stringify(services));
        }

        function updateSubmitButtonStatus() {
            submitFinalBtn.disabled = services.length === 0;
        }

        submitFinalBtn.addEventListener('click', () => {
            alert('خدمات با موفقیت ثبت شد!');
            console.log('خدمات ثبت شده:', services);
            // در اینجا می‌توان اطلاعات را به سرور ارسال کرد یا به صفحه دیگری منتقل شد
        });
    </script>
</body>
</html>
