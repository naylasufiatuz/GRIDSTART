@extends('app')

@section('content')

<!-- CONTACT HERO -->
<section class="contact-hero">
  <div class="contact-hero-content fade-up">
    <small class="hero-label">GET IN TOUCH</small>
    <h1>Yuk, Ngobrol Bareng! 💬</h1>
    <p>
      Ada pertanyaan? Mau saran? Atau sekadar ingin cerita pengalaman berkendara aman kamu? 
      Kami sini untuk dengerin! 🏁
    </p>
  </div>
</section>

<!-- MAIN CONTACT SECTION -->
<section class="contact-section">
  <div class="contact-container">

    <!-- LEFT: FORM -->
    <div class="contact-form-wrapper">
      <div class="form-header">
        <h2>Pesen Kami</h2>
        <p>Balas cepat, biasanya dalam 24 jam ⚡</p>
      </div>

      <form class="contact-form" id="contactForm">
        @csrf
        <!-- NAME INPUT -->
        <div class="form-group">
          <label for="name" class="form-label">Nama</label>
          <input 
            type="text" 
            id="name" 
            name="name" 
            class="form-input" 
            placeholder="Nama kamu"
            required
          >
          <span class="form-error" id="nameError"></span>
        </div>

        <!-- EMAIL INPUT -->
        <div class="form-group">
          <label for="email" class="form-label">Email</label>
          <input 
            type="email" 
            id="email" 
            name="email" 
            class="form-input" 
            placeholder="email@example.com"
            required
          >
          <span class="form-error" id="emailError"></span>
        </div>

        <!-- PHONE INPUT -->
        <div class="form-group">
          <label for="phone" class="form-label">Nomor WhatsApp (Optional)</label>
          <input 
            type="tel" 
            id="phone" 
            name="phone" 
            class="form-input" 
            placeholder="+62 XXX XXXX XXXX"
          >
        </div>

        <!-- SUBJECT SELECT -->
        <div class="form-group">
          <label for="subject" class="form-label">Topik Pertanyaan</label>
          <select id="subject" name="subject" class="form-input" required>
            <option value="">Pilih topik...</option>
            <option value="general">📍 Pertanyaan Umum</option>
            <option value="edukasi">📚 Tentang Edukasi</option>
            <option value="simulasi">🎮 Tentang Simulasi</option>
            <option value="bug">🐛 Laporin Bug</option>
            <option value="partnership">🤝 Kerjasama</option>
            <option value="other">⭐ Lainnya</option>
          </select>
          <span class="form-error" id="subjectError"></span>
        </div>

        <!-- MESSAGE TEXTAREA -->
        <div class="form-group">
          <label for="message" class="form-label">Pesan</label>
          <textarea 
            id="message" 
            name="message" 
            class="form-textarea" 
            placeholder="Cerita dong... 👂"
            rows="5"
            required
          ></textarea>
          <span class="form-error" id="messageError"></span>
        </div>

        <!-- CHECKBOX -->
        <div class="form-group checkbox-group">
          <input 
            type="checkbox" 
            id="agree" 
            name="agree" 
            class="form-checkbox"
            required
          >
          <label for="agree" class="checkbox-label">
            Boleh aku dihubungi via email 📧
          </label>
          <span class="form-error" id="agreeError"></span>
        </div>

        <!-- SUBMIT BUTTON -->
        <button type="submit" class="submit-btn">
          <span class="btn-text">Kirim Pesan</span>
          <span class="btn-arrow">→</span>
        </button>

        <!-- SUCCESS MESSAGE -->
        <div class="form-success" id="successMessage" style="display: none;">
          ✅ Pesan terkirim! Terima kasih! 🎉
        </div>
      </form>
    </div>

    <!-- RIGHT: CONTACT INFO -->
    <div class="contact-info-wrapper">
      
      <!-- SOCIAL MEDIA -->
      <div class="social-section">
        <h3>Follow Kita!</h3>
        <div class="social-grid">
          <a href="https://instagram.com/gridstart" class="social-btn insta" target="_blank" rel="noopener" title="Instagram">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke="currentColor" stroke-width="1" fill="none"/>
              <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1" fill="none"/>
              <circle cx="17.5" cy="6.5" r="1.5" fill="currentColor"/>
            </svg>
          </a>
          <a href="https://twitter.com/gridstart" class="social-btn twitter" target="_blank" rel="noopener" title="Twitter">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75 2.25 9 5.5 9 5.5" stroke="currentColor" stroke-width="1" fill="none"/>
            </svg>
          </a>
          <a href="https://youtube.com/@gridstart" class="social-btn youtube" target="_blank" rel="noopener" title="YouTube">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.33z" stroke="currentColor" stroke-width="1" fill="none"/>
              <polygon points="9.75 15.02 15.5 11.75 9.75 8.48" stroke="currentColor" stroke-width="1" fill="none"/>
            </svg>
          </a>
          <a href="https://discord.gg/gridstart" class="social-btn discord" target="_blank" rel="noopener" title="Discord">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M20.317 4.3671a19.8 19.8 0 00-4.885-1.515a.074.074 0 00-.079.037c-.211.375-.445.864-.608 1.25a18.27 18.27 0 00-5.487 0c-.163-.386-.397-.875-.608-1.25a.077.077 0 00-.079-.037A19.892 19.892 0 003.692 4.367a.07.07 0 00-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 00.031.057a19.9 19.9 0 005.993 3.03a.078.078 0 00.084-.028a14.975 14.975 0 001.293-2.1a.07.07 0 00-.038-.098a13.11 13.11 0 01-1.872-.892.072.072 0 01-.009-.119c.126-.093.252-.19.372-.287a.075.075 0 01.078-.01c3.928 1.793 8.18 1.793 12.062 0a.075.075 0 01.079.009c.12.098.246.195.372.288a.072.072 0 01-.01.119a12.901 12.901 0 01-1.872.892a.07.07 0 00-.037.099a14.047 14.047 0 001.293 2.1a.078.078 0 00.084.028a19.963 19.963 0 006.002-3.03a.079.079 0 00.033-.057c.5-4.761-.838-8.89-3.556-12.541a.06.06 0 00-.031-.03z"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- RESPONSE TIME -->
      <div class="response-time-card">
        <div class="response-icon">⏱️</div>
        <p class="response-title">Waktu Respon</p>
        <p class="response-text">Balik dalam <strong>24 jam</strong></p>
        <p class="response-subtitle">Janji kami! 🤝</p>
      </div>

    </div>

  </div>
</section>

<!-- FAQ SECTION -->
<section class="faq-section">
  <div class="faq-container">
    <div class="faq-header">
      <h2>Pertanyaan yang Sering Diajukan</h2>
      <p>Mungkin pertanyaan kamu udah ada di sini 👇</p>
    </div>

    <div class="faq-grid">
      
      <!-- FAQ ITEM 1 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>GridStart bayar atau gratis?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>Gratis! Karena kami percaya safety itu hak semua orang. Kalau suka, boleh di-share ke temen-temen kamu 💚</p>
        </div>
      </div>

      <!-- FAQ ITEM 2 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>Simulasinya realistis ga?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>Banget! Physics-nya real, sama kerjasama dengan instruktur profesional. Jadi bener-bener terasa kayak nyetir beneran 🎮</p>
        </div>
      </div>

      <!-- FAQ ITEM 3 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>Umur berapa yang cocok buat GridStart?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>GridStart cocok untuk semua umur, mulai dari 13 tahun (pelajar SMP) sampai orang tua. Tapi khususnya untuk yang mau belajar berkendara aman sebelum punya SIM. 🏎️</p>
        </div>
      </div>

      <!-- FAQ ITEM 4 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>Data aku aman ga?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>Jelas aman! Semua data dienkripsi dan kami pegang prinsip keamanan yang ketat. Privacy kamu prioritas kami 🔐</p>
        </div>
      </div>

      <!-- FAQ ITEM 5 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>Bisa offline? Gimana kalau sinyal jelek?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>Materi edukasi bisa dibuka offline. Simulasi perlu internet yang stabil soalnya physics-nya real-time, tapi kami juga optimize untuk koneksi yang pas-pasan 📡</p>
        </div>
      </div>

      <!-- FAQ ITEM 6 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>Gimana cara kolaborasi sama GridStart?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>Kami open banget untuk partnership! Hubungi aja kami via email atau DM Instagram. Kita bahas detail-detailnya langsung 🤝</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CTA SECTION -->
<section class="cta-contact-section">
  <div class="cta-content">
    <h2>Siap Jadi Bagian dari GridStart? 🏁</h2>
    <p>Mulai belajar berkendara aman hari ini dan dapatkan sertifikat digital</p>
    <a href="/start-grid" class="cta-contact-btn">Mulai Belajar Sekarang</a>
  </div>
</section>

<script>
  // FORM HANDLING
  const contactForm = document.getElementById('contactForm');
  const successMessage = document.getElementById('successMessage');

  contactForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Simple validation
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;
    
    if(name && email && message) {
      // Here you would send the form data to your backend
      // For now, just show success message
      contactForm.style.display = 'none';
      successMessage.style.display = 'block';
      
      setTimeout(() => {
        contactForm.style.display = 'block';
        successMessage.style.display = 'none';
        contactForm.reset();
      }, 3000);
    }
  });

  // FAQ ACCORDION
  const faqQuestions = document.querySelectorAll('.faq-question');
  
  faqQuestions.forEach(question => {
    question.addEventListener('click', function() {
      const faqItem = this.parentElement;
      const isActive = faqItem.classList.contains('active');
      
      // Close all other FAQ items
      document.querySelectorAll('.faq-item').forEach(item => {
        item.classList.remove('active');
      });
      
      // Toggle current item
      if(!isActive) {
        faqItem.classList.add('active');
      }
    });
  });
</script>

@endsection
