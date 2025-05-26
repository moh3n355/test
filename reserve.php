<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>جدول رزرو هفتگی</title>
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
    }

    .container {
      max-width: 1000px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #a475f9;
      font-weight: 700;
    }

    .controls {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 20px;
    }

    button {
      background-color: #a475f9;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 14px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
      font-weight: 500;
    }

    button:hover {
      background-color: #8e5af7;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      border: 2px solid #d1c4e9;
      padding: 10px;
      text-align: center;
      vertical-align: middle;
      transition: all 0.3s;
    }

    th {
      background-color: #f7d9e3;
      color: #444;
    }

    .slot {
      cursor: pointer;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      user-select: none;
    }

    .available {
      background-color: #c8e6c9;
      color: #2e7d32;
    }

    .reserved {
      background-color: #ffcdd2;
      color: #b71c1c;
    }

    .closed {
      background-color: #b0bec5;
      color: #37474f;
    }

    .date-label {
      font-size: 12px;
      color: #777;
      margin-top: 5px;
      display: block;
    }

    .submit-btn {
      background-color: #a475f9;
      color: white;
      border: none;
      padding: 12px 25px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      display: block;
      width: 100%;
      font-weight: 500;
    }

    .submit-btn:hover {
      background-color: #8e5af7;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>جدول رزرو هفتگی</h1>

    <div class="controls">
      <button onclick="switchWeek(0)">هفته جاری</button>
      <button onclick="switchWeek(1)">هفته بعد</button>
    </div>

    <table id="reservationTable"></table>

    <button class="submit-btn" onclick="submitReservations()">ثبت رزروها</button>
  </div>

  <script>
    const table = document.getElementById('reservationTable');
    let weekOffset = 0;

    function getShamsiDate(date) {
      const fa = new Intl.DateTimeFormat('fa-IR', {
        month: '2-digit',
        day: '2-digit',
      });
      return fa.format(date);
    }

    function generateTable() {
      table.innerHTML = '';

      const headerRow = document.createElement('tr');
      headerRow.appendChild(document.createElement('th')); // ستون ساعت خالی

      const today = new Date();
      const base = new Date(today);
      base.setDate(today.getDate() + weekOffset * 7);

      const days = ['شنبه', 'یک‌شنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه'];
      const dateRefs = [];

      for (let i = 0; i < 7; i++) {
        const d = new Date(base);
        d.setDate(base.getDate() - base.getDay() + (i + 6) % 7);
        dateRefs.push(d);

        const th = document.createElement('th');
        th.innerHTML = `${days[i]}<span class="date-label">${getShamsiDate(d)}</span>`;
        headerRow.appendChild(th);
      }

      table.appendChild(headerRow);

      for (let hour = 8; hour <= 22; hour++) {
        const row = document.createElement('tr');
        const hourCell = document.createElement('td');
        hourCell.textContent = `${hour}:00`;
        row.appendChild(hourCell);

        for (let day = 0; day < 7; day++) {
          const cell = document.createElement('td');
          cell.className = 'slot available';
          cell.textContent = 'در دسترس';
          cell.dataset.status = 'available';

          cell.onclick = () => {
            if (cell.dataset.status === 'available') {
              cell.dataset.status = 'reserved';
              cell.className = 'slot reserved';
              cell.textContent = 'رزرو شده';
            } else if (cell.dataset.status === 'reserved') {
              cell.dataset.status = 'closed';
              cell.className = 'slot closed';
              cell.textContent = 'تعطیل است';
            } else {
              cell.dataset.status = 'available';
              cell.className = 'slot available';
              cell.textContent = 'در دسترس';
            }
          };

          row.appendChild(cell);
        }

        table.appendChild(row);
      }
    }

    function switchWeek(offset) {
      if (offset === 0 || offset === 1) {
        weekOffset = offset;
        generateTable();
      }
    }

    function submitReservations() {
      const reserved = [];
      const closed = [];
      const rows = table.querySelectorAll('tr');

      rows.forEach((row, rowIndex) => {
        if (rowIndex === 0) return;

        const hour = 8 + rowIndex - 1;
        const cells = row.querySelectorAll('td');
        for (let i = 1; i < cells.length; i++) {
          if (cells[i].dataset.status === 'reserved') {
            reserved.push({
              day: i - 1,
              hour: hour,
              weekOffset: weekOffset
            });
          } else if (cells[i].dataset.status === 'closed') {
            closed.push({
              day: i - 1,
              hour: hour,
              weekOffset: weekOffset
            });
          }
        }
      });

      console.log('رزروهای ثبت شده:', reserved);
      console.log('ساعات تعطیل شده:', closed);
      alert('رزروها و ساعات تعطیل ثبت شدند (برای تست در Console ببینید)');
    }

    generateTable();
  </script>
</body>
</html>
