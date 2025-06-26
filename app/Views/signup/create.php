
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4">Signup (API Based)</h3>
        <!-- <div id="messageBox"></div> -->
        <form id="signupForm">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
                <div id="error-username" class="text-danger small"></div>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
                <div id="error-email" class="text-danger small"></div>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <div id="error-password" class="text-danger small"></div>
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
</div>
<script>
    document.getElementById('signupForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        // Clear old errors
        ['username', 'email', 'password'].forEach(field => {
            document.getElementById('error-' + field).textContent = '';
        });

        const form = e.target;
        const formData = new FormData(form);
        const payload = Object.fromEntries(formData.entries());

        const res = await fetch('/api/signupcreate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const result = await res.json();

        if (res.ok) {
            alert(result.message); // or success alert box
            form.reset();
        } else {
            const errors = result.messages;
            for (const field in errors) {
                if (document.getElementById('error-' + field)) {
                    document.getElementById('error-' + field).textContent = errors[field];
                }
            }
        }
    });
</script>


<!-- <div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4">Signup (API Based)</h3>

        <div id="messageBox"></div> 

        <form id="signupForm">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('signupForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const payload = Object.fromEntries(formData.entries());

        const res = await fetch('/api/signupcreate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const result = await res.json();
        const box = document.getElementById('messageBox');

        if (res.ok) {
            box.innerHTML = `<div class="alert alert-success">${result.message}</div>`;
            form.reset();
        } else {
            // const messages = Object.values(result.messages).join('<br>');
            // let errors = Object.values(result.messages).join('<br>');
            const messages = result.messages ?
                Object.values(result.messages).join('<br>') :
                result.message || 'Something went wrong!';
            box.innerHTML = `<div class="alert alert-danger">${messages}</div>`;
        }
    });
</script> -->


<!-- 
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4">Signup (Using API)</h3>

        ✅ For success/error messages 
        <div id="messageBox"></div>

        <form id="signupForm">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>

✅ JavaScript fetch to API
<script>
    document.getElementById('signupForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const payload = Object.fromEntries(formData.entries());
        console.log(payload);

        const response = await fetch('/api/signupcreate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const result = await response.json();
        const box = document.getElementById('messageBox');

        if (response.ok) {
            box.innerHTML = `<div class="alert alert-success">${result.message}</div>`;
            this.reset();
        } else {
            // let errors = Object.values(result.messages).join('<br>');
            let errors = result.messages ?
                Object.values(result.messages).join('<br>') :
                result.message || 'Something went wrong!';

            box.innerHTML = `<div class="alert alert-danger">${errors}</div>`;
        }
    });
</script> -->