<div id="logout-timer" style="position:fixed;bottom:10px;right:10px;background:#ffc107;padding:10px;border-radius:5px;">
    Auto logout in <span id="timer">4</span> seconds
</div>

<script>
    const maxInactivity = 25 * 1000; // 25 seconds
    let timerValue = 4; // seconds
    let logoutTimer;
    let countdownInterval;

    function resetInactivityTimer() {
        clearTimeout(logoutTimer);
        clearInterval(countdownInterval);
        timerValue = 4;
        document.getElementById('timer').textContent = timerValue;

        countdownInterval = setInterval(() => {
            timerValue--;
            if (timerValue <= 0) clearInterval(countdownInterval);
            document.getElementById('timer').textContent = timerValue;
        }, 1000);

        logoutTimer = setTimeout(() => {
            window.location.href = 'admin/logout';
        }, maxInactivity);
    }

    ['mousemove', 'keydown', 'click'].forEach(event =>
        document.addEventListener(event, resetInactivityTimer)
    );

    resetInactivityTimer(); // Initial start
</script>
