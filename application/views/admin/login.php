<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo isset($title) ? $title : '@CMS :: Login'; ?></title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bulma CSS & FontAwesome -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 50%, #ec4899 100%);
      --bg-gradient: radial-gradient(circle at 10% 20%, rgba(99, 102, 241, 0.15) 0%, transparent 40%),
                     radial-gradient(circle at 90% 80%, rgba(236, 72, 153, 0.15) 0%, transparent 40%),
                     #0f172a;
    }

    * {
      font-family: 'Plus Jakarta Sans', sans-serif;
      box-sizing: border-box;
    }

    body {
      background: var(--bg-gradient);
      min-height: 100vh;
      color: #e2e8f0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-hero {
      position: relative;
      overflow: hidden;
      width: 100%;
    }

    /* Ambient background glow */
    .glow-circle {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      z-index: 0;
      pointer-events: none;
    }
    .glow-1 {
      width: 350px;
      height: 350px;
      background: rgba(99, 102, 241, 0.25);
      top: 10%;
      left: 15%;
    }
    .glow-2 {
      width: 300px;
      height: 300px;
      background: rgba(236, 72, 153, 0.2);
      bottom: 10%;
      right: 15%;
    }

    .login-card {
      position: relative;
      z-index: 1;
      background: rgba(30, 41, 59, 0.75);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 24px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
      padding: 2.5rem;
      transition: all 0.3s ease;
    }

    .brand-badge {
      width: 60px;
      height: 60px;
      background: var(--primary-gradient);
      border-radius: 18px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 1.6rem;
      box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
      margin-bottom: 1.25rem;
    }

    .login-title {
      font-size: 1.5rem;
      font-weight: 800;
      color: #ffffff;
      margin: 0 0 0.4rem 0 !important;
      line-height: 1.25;
      letter-spacing: -0.02em;
    }

    .login-subtitle {
      font-size: 0.875rem;
      color: #94a3b8;
      margin: 0 0 1.5rem 0 !important;
      line-height: 1.4;
    }

    .input-custom {
      background: rgba(15, 23, 42, 0.6) !important;
      border: 1px solid rgba(255, 255, 255, 0.12) !important;
      color: #f8fafc !important;
      border-radius: 12px !important;
      padding-left: 2.75rem !important;
      height: 3rem !important;
      transition: all 0.2s ease;
    }

    .input-custom:focus {
      border-color: #818cf8 !important;
      box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.25) !important;
      background: rgba(15, 23, 42, 0.85) !important;
    }

    .input-custom::placeholder {
      color: #64748b !important;
    }

    .icon.is-left {
      height: 3rem !important;
      color: #94a3b8 !important;
    }

    .btn-login {
      background: var(--primary-gradient) !important;
      border: none !important;
      color: #ffffff !important;
      font-weight: 700 !important;
      height: 3rem !important;
      border-radius: 12px !important;
      box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4) !important;
      transition: all 0.25s ease !important;
      width: 100%;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 25px -5px rgba(99, 102, 241, 0.5) !important;
    }

    .btn-login:active {
      transform: translateY(0);
    }

    /* Demo account box */
    .demo-box {
      background: rgba(15, 23, 42, 0.55);
      border: 1px dashed rgba(129, 140, 248, 0.35);
      border-radius: 16px;
      padding: 1.1rem 1.25rem;
      margin-top: 1.5rem;
    }

    .demo-pill {
      background: rgba(99, 102, 241, 0.12);
      border: 1px solid rgba(99, 102, 241, 0.3);
      color: #c7d2fe;
      border-radius: 10px;
      padding: 0.6rem 0.85rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: all 0.2s ease;
      margin-top: 0.6rem;
    }

    .demo-pill:hover {
      background: rgba(99, 102, 241, 0.25);
      border-color: #818cf8;
      transform: translateY(-1px);
    }

    .demo-pill code {
      background: rgba(15, 23, 42, 0.8) !important;
      color: #38bdf8 !important;
      border: 1px solid rgba(255, 255, 255, 0.1) !important;
      padding: 0.15rem 0.45rem !important;
      border-radius: 6px !important;
      font-size: 0.75rem !important;
      font-family: monospace;
    }

    .notification.is-custom-danger {
      background: rgba(239, 68, 68, 0.15);
      border: 1px solid rgba(239, 68, 68, 0.3);
      color: #fca5a5;
      border-radius: 12px;
      font-size: 0.875rem;
      padding: 0.875rem 1rem;
    }

    .notification.is-custom-success {
      background: rgba(34, 197, 94, 0.15);
      border: 1px solid rgba(34, 197, 94, 0.3);
      color: #86efac;
      border-radius: 12px;
      font-size: 0.875rem;
      padding: 0.875rem 1rem;
    }

    .toggle-password {
      pointer-events: auto !important;
      cursor: pointer;
      color: #94a3b8;
      height: 3rem !important;
      right: 0 !important;
      position: absolute !important;
      top: 0;
      width: 3rem;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 4;
    }

    .toggle-password:hover {
      color: #f8fafc;
    }
  </style>
</head>

<body>
  <div class="glow-circle glow-1"></div>
  <div class="glow-circle glow-2"></div>

  <section class="hero is-fullheight login-hero">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-5-tablet is-4-desktop is-4-widescreen">
            
            <div class="login-card">
              <!-- Header Brand -->
              <div class="has-text-centered">
                <div class="brand-badge">
                  <i class="fa-solid fa-layer-group"></i>
                </div>
                <h1 class="login-title">Selamat Datang</h1>
                <p class="login-subtitle">Silakan masuk ke panel admin</p>
              </div>

              <!-- Notifications / Alerts -->
              <?php if ( ! isset( $on_hold_message ) ): ?>
                <?php if ( isset( $login_error_mesg ) ): ?>
                  <div class="notification is-custom-danger mb-4">
                    <div class="is-flex is-align-items-center">
                      <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                      <div>
                        <strong>Login Gagal (<?php echo $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts'); ?>)</strong>
                        <div class="is-size-7">Username atau password yang Anda masukkan salah.</div>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if ( $this->input->get('logout') ): ?>
                  <div class="notification is-custom-success mb-4">
                    <div class="is-flex is-align-items-center">
                      <i class="fa-solid fa-circle-check mr-2"></i>
                      <span>Anda telah berhasil logout.</span>
                    </div>
                  </div>
                <?php endif; ?>

                <!-- Form Login -->
                <?php echo form_open( $login_url, ['class' => 'std-form', 'id' => 'form_login'] ); ?>
                  
                  <!-- Input Username -->
                  <div class="field mb-4">
                    <label class="label has-text-grey-light is-size-7 mb-1">Username / Email</label>
                    <div class="control has-icons-left">
                      <input 
                        type="text" 
                        name="login_string" 
                        id="login_string" 
                        class="input input-custom" 
                        autocomplete="off" 
                        maxlength="255" 
                        placeholder="Masukkan username" 
                        required 
                      />
                      <span class="icon is-small is-left">
                        <i class="fa-solid fa-user"></i>
                      </span>
                    </div>
                  </div>

                  <!-- Input Password -->
                  <div class="field mb-5">
                    <label class="label has-text-grey-light is-size-7 mb-1">Password</label>
                    <div class="control has-icons-left is-relative">
                      <input 
                        type="password" 
                        name="login_pass" 
                        id="login_pass" 
                        class="input input-custom" 
                        maxlength="<?php echo config_item('max_chars_for_password'); ?>" 
                        autocomplete="off" 
                        readonly="readonly" 
                        onfocus="this.removeAttribute('readonly');" 
                        placeholder="••••••••" 
                        required 
                      />
                      <span class="icon is-small is-left">
                        <i class="fa-solid fa-lock"></i>
                      </span>
                      <span class="toggle-password" onclick="togglePassVisibility()">
                        <i class="fa-solid fa-eye" id="eye_icon"></i>
                      </span>
                    </div>
                  </div>

                  <!-- Submit Button -->
                  <div class="field mb-4">
                    <button type="submit" class="button btn-login" name="submit" value="Login" id="submit_button">
                      <i class="fa-solid fa-right-to-bracket mr-2"></i> Masuk ke Dashboard
                    </button>
                  </div>

                </form>

                <!-- Demo Credentials Box -->
                <div class="demo-box">
                  <div class="is-flex is-align-items-center is-justify-content-space-between">
                    <span class="is-size-7 has-text-weight-semibold has-text-grey-light">
                      <i class="fa-solid fa-key mr-1 has-text-warning"></i> Akun Demo
                    </span>
                    <span class="tag is-info is-light is-rounded is-size-7">Klik untuk isi otomatis</span>
                  </div>

                  <div class="demo-pill" onclick="fillDemo('admin', 'Admin1234')">
                    <div>
                      <strong class="has-text-white is-size-7">Admin Utama</strong>
                      <div class="is-size-7 has-text-grey-light mt-1">User: <code>admin</code> | Pass: <code>Admin1234</code></div>
                    </div>
                    <i class="fa-solid fa-arrow-turn-down has-text-info"></i>
                  </div>
                </div>

              <?php else: ?>
                <!-- Excessive login attempts message -->
                <div class="notification is-custom-danger">
                  <div class="has-text-centered mb-2">
                    <i class="fa-solid fa-ban fa-2x mb-2"></i>
                    <h2 class="subtitle is-6 has-text-weight-bold has-text-danger-light">Terlalu Banyak Percobaan</h2>
                  </div>
                  <p class="is-size-7 mb-3">
                    Akses login sementara diblokir selama <?php echo ( (int) config_item('seconds_on_hold') / 60 ); ?> menit demi keamanan.
                  </p>
                </div>
              <?php endif; ?>

              <!-- Footer -->
              <div class="has-text-centered mt-5">
                <p class="is-size-7 has-text-grey-darker">&copy; <?php echo date('Y'); ?> Admin CMS. All rights reserved.</p>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    function fillDemo(username, password) {
      const userInput = document.getElementById('login_string');
      const passInput = document.getElementById('login_pass');
      
      userInput.value = username;
      passInput.removeAttribute('readonly');
      passInput.value = password;

      userInput.focus();
    }

    function togglePassVisibility() {
      const passInput = document.getElementById('login_pass');
      const eyeIcon = document.getElementById('eye_icon');
      
      if (passInput.type === 'password') {
        passInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      } else {
        passInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      }
    }
  </script>
</body>
</html>