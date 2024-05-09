<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pop-up Form</title>
</head>
<body>

<style>
.popup {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
}

.popup-content {
  background-color: #fefefe;
  margin: 10% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.closeBtn {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closeBtn:hover,
.closeBtn:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const openBtn = document.getElementById('openBtn');
  const popupForm = document.getElementById('popupForm');
  const closeBtn = popupForm.querySelector('.closeBtn');

  openBtn.addEventListener('click', function () {
    popupForm.style.display = 'block';
  });

  closeBtn.addEventListener('click', function () {
    popupForm.style.display = 'none';
  });

  window.addEventListener('click', function (e) {
    if (e.target === popupForm) {
      popupForm.style.display = 'none';
    }
  });
});
</script>

  <button id="openBtn">Open Form</button>

  <div id="popupForm" class="popup">
    <form class="popup-content">
      <span class="closeBtn">&times;</span>
      <h2>Pop-up Form</h2>
      <input type="text" placeholder="Enter your name">
      <input type="email" placeholder="Enter your email">
      <button type="submit">Submit</button>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>