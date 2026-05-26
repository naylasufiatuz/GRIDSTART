@extends('app')

@section('content')

<!-- CONTACT HERO -->
<section class="contact-hero">
  <div class="contact-hero-content fade-up">
    <small class="hero-label">GET IN TOUCH</small>
    <div class="hero-heading">
      <span class="hero-icon">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 4h16v12H7l-4 4V4z" />
          <path d="M8 8h8" />
          <path d="M8 12h5" />
        </svg>
      </span>
      <h1>Yuk, Ngobrol Bareng!</h1>
    </div>
    <p>
      Ada pertanyaan? Mau saran? Atau sekadar ingin cerita pengalaman berkendara aman kamu?
      Kami siap mendengarkan.
    </p>
  </div>
</section>

<!-- MAIN CONTACT SECTION -->
<section class="contact-section">
  <div class="contact-container single-column">

    <!-- LEFT: FORM -->
    <div class="contact-form-wrapper neumorphic">
      <div class="form-header">
        <h2>Pesen Kami</h2>
        <p>Isi detail singkat, kami akan bantu jawab dengan jelas dan cepat.</p>
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
            class="form-input neumorphic-inset" 
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
            class="form-input neumorphic-inset" 
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
            class="form-input neumorphic-inset" 
            placeholder="+62 XXX XXXX XXXX"
          >
        </div>

        <!-- SUBJECT SELECT -->
        <div class="form-group">
          <label for="subject" class="form-label">Topik Pertanyaan</label>
          <select id="subject" name="subject" class="form-input neumorphic-inset" required>
            <option value="">Pilih topik...</option>
            <option value="general">Pertanyaan Umum</option>
            <option value="edukasi">Tentang Edukasi</option>
            <option value="simulasi">Tentang Simulasi</option>
            <option value="bug">Laporin Bug</option>
            <option value="partnership">Kerjasama</option>
            <option value="other">Lainnya</option>
          </select>
          <span class="form-error" id="subjectError"></span>
        </div>

        <!-- MESSAGE TEXTAREA -->
        <div class="form-group">
          <label for="message" class="form-label">Pesan</label>
          <textarea 
            id="message" 
            name="message" 
            class="form-textarea neumorphic-inset" 
            placeholder="Cerita dong..."
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
            Boleh aku dihubungi via email
          </label>
          <span class="form-error" id="agreeError"></span>
        </div>

        <!-- SUBMIT BUTTON -->
        <button type="submit" class="submit-btn neumorphic-button">
          <span class="btn-text">Kirim Pesan</span>
          <span class="btn-arrow">→</span>
        </button>

        <!-- SUCCESS MESSAGE -->
        <div class="form-success" id="successMessage" style="display: none;">
          <span class="success-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 6L9 17l-5-5" />
            </svg>
          </span>
          Pesan terkirim! Terima kasih!
        </div>
      </form>
    </div>

  </div>
</section>

<!-- FAQ SECTION -->
<section class="faq-section">
  <div class="faq-container">
    <div class="faq-header">
      <h2>Pertanyaan yang Sering Diajukan</h2>
      <p>Mungkin pertanyaan kamu sudah ada di sini.</p>
    </div>

    <div class="faq-grid">
      
      <!-- FAQ ITEM 1 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>GridStart bayar atau gratis?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>Gratis! Karena kami percaya safety itu hak semua orang. Kalau suka, boleh di-share ke temen-temen kamu.</p>
        </div>
      </div>

      <!-- FAQ ITEM 2 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>Simulasinya realistis ga?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>Banget! Physics-nya real, sama kerjasama dengan instruktur profesional. Jadi bener-bener terasa kayak nyetir beneran.</p>
        </div>
      </div>

      <!-- FAQ ITEM 3 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>Umur berapa yang cocok buat GridStart?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>GridStart cocok untuk semua umur, mulai dari 13 tahun (pelajar SMP) sampai orang tua. Tapi khususnya untuk yang mau belajar berkendara aman sebelum punya SIM.</p>
        </div>
      </div>

      <!-- FAQ ITEM 4 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>Data aku aman ga?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>Jelas aman! Semua data dienkripsi dan kami pegang prinsip keamanan yang ketat. Privacy kamu prioritas kami.</p>
        </div>
      </div>

      <!-- FAQ ITEM 5 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>Bisa offline? Gimana kalau sinyal jelek?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>Materi edukasi bisa dibuka offline. Simulasi perlu internet yang stabil soalnya physics-nya real-time, tapi kami juga optimize untuk koneksi yang pas-pasan.</p>
        </div>
      </div>

      <!-- FAQ ITEM 6 -->
      <div class="faq-item">
        <button class="faq-question">
          <span>Gimana cara kolaborasi sama GridStart?</span>
          <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer">
          <p>Kami open banget untuk partnership! Hubungi aja kami via email atau DM Instagram. Kita bahas detail-detailnya langsung.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CTA SECTION -->
<section class="cta-contact-section">
  <div class="cta-content">
    <h2>Siap Jadi Bagian dari GridStart?</h2>
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
