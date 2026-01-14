<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Направление движения по мосту</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body { margin:0; font-family:Arial,sans-serif; background:#000; color:#fff; display:flex; justify-content:space-between; align-items:center; height:100vh; padding:0 80px; }
.main { text-align:center; }
.arrow { font-size:160px; transition: 0.5s; }
.text { font-size:48px; font-weight:bold; margin-top:30px; transition: 0.5s; }
.info { text-align:right; color:#ccc; font-size:36px; }
.time { font-size:28px; margin-top:20px; }
</style>
</head>
<body>
<div class="main">
    <div id="arrow" class="arrow">➡️</div>
    <div id="text" class="text">ДВИЖЕНИЕ С ЛЕВОГО БЕРЕГА</div>
</div>
<div class="info">
    <div>Интервал:</div>
    <div id="interval">05:00 – 08:29</div>
    <div class="time" id="time">Омское время:<br>00:00</div>
</div>

<script>
const schedule = [
    [300, 509,  "С ЛЕВОГО БЕРЕГА",  "➡️", "#1e7e34", "05:00 – 08:29"],
    [510, 569,  "С ПРАВОГО БЕРЕГА", "⬅️", "#004085", "08:30 – 09:29"],
    [570, 659,  "С ЛЕВОГО БЕРЕГА",  "➡️", "#1e7e34", "09:30 – 10:59"],
    [660, 734,  "С ПРАВОГО БЕРЕГА", "⬅️", "#004085", "11:00 – 12:14"],
    [735, 824,  "С ЛЕВОГО БЕРЕГА",  "➡️", "#1e7e34", "12:15 – 13:44"],
    [825, 899,  "С ПРАВОГО БЕРЕГА", "⬅️", "#004085", "13:45 – 14:59"],
    [900, 989,  "С ЛЕВОГО БЕРЕГА",  "➡️", "#1e7e34", "15:00 – 16:29"],
    [990, 1184, "С ПРАВОГО БЕРЕГА", "⬅️", "#004085", "16:30 – 19:44"],
    [1185,1229, "С ЛЕВОГО БЕРЕГА",  "➡️", "#1e7e34", "19:45 – 20:29"],
    [1230,1274, "С ПРАВОГО БЕРЕГА", "⬅️", "#004085", "20:30 – 21:14"],
    [1275,1379, "С ЛЕВОГО БЕРЕГА",  "➡️", "#1e7e34", "21:15 – 22:59"],
];

function getBridgeStatus() {
    const now = new Date();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const totalMinutes = hours*60 + minutes;

    for (let s of schedule) {
        if (totalMinutes >= s[0] && totalMinutes <= s[1]) {
            return {text: "ДВИЖЕНИЕ " + s[2], arrow: s[3], color: s[4], interval: s[5]};
        }
    }

    // Ночной интервал
    return {text: "ДВИЖЕНИЕ С ПРАВОГО БЕРЕГА", arrow: "⬅️", color: "#004085", interval: "23:00 – 04:59"};
}

function updateBridgeStatus() {
    const status = getBridgeStatus();
    document.getElementById('arrow').textContent = status.arrow;
    const textEl = document.getElementById('text');
    textEl.textContent = status.text;
    textEl.style.color = status.color;
    document.getElementById('interval').textContent = status.interval;

    const now = new Date();
    const hh = String(now.getHours()).padStart(2,'0');
    const mm = String(now.getMinutes()).padStart(2,'0');
    document.getElementById('time').innerHTML = `Омское время:<br>${hh}:${mm}`;
}

// Обновляем каждую секунду
updateBridgeStatus();
setInterval(updateBridgeStatus, 1000);
</script>
</body>
</html>
