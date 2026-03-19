let currentStep = 1;
const totalSteps = 10;

const nextBtn = document.getElementById('next-btn');
const prevBtn = document.getElementById('prev-btn');
const submitBtn = document.getElementById('submit-btn');
const quizForm = document.getElementById('quiz-form');
const progressBar = document.getElementById('progress-bar');
const sectionIntro = document.getElementById('sobre');

// 1. Efeito de Máquina de Escrever
function typeWriter(element, text, speed = 50) {
  element.textContent = ''; 
  let i = 0;
  return new Promise(resolve => {
    function type() {
      if (i < text.length) {
        element.textContent += text.charAt(i);
        i++;
        setTimeout(type, speed);
      } else {
        resolve();
      }
    }
    type();
  });
}

// 2. Atalhos de Teclado
function setupKeyboardShortcuts() {
  window.addEventListener('keydown', (e) => {
    // Atalhos: 1-4
    const key = e.key;
    const map = {
      '1': 0, '2': 1, '3': 2, '4': 3
    };

    if (map.hasOwnProperty(key)) {
      const currentCard = document.getElementById('q' + currentStep);
      if (currentCard) {
        const options = currentCard.querySelectorAll('input[type="radio"]');
        if (options[map[key]]) {
          options[map[key]].checked = true;
        }
      }
    }

    // Enter para avançar
    if (e.key === 'Enter') {
      e.preventDefault();
      if (currentStep < totalSteps) {
        nextBtn.click();
      } else if (submitBtn && submitBtn.style.display !== 'none') {
        submitBtn.click();
      }
    }
  });
}

// 3. Efeito de Celebração (Confetes)
function celebrate() {
  const colors = ['#009432', '#2ecc71', '#f1c40f', '#3498db', '#e74c3c'];
  for (let i = 0; i < 100; i++) {
    const confetti = document.createElement('div');
    confetti.className = 'confetti';
    confetti.style.left = Math.random() * 100 + 'vw';
    confetti.style.top = -10 + 'px';
    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
    confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
    
    document.body.appendChild(confetti);

    const animation = confetti.animate([
      { transform: `translate3d(0, 0, 0) rotate(0deg)`, opacity: 1 },
      { transform: `translate3d(${(Math.random() - 0.5) * 200}px, 100vh, 0) rotate(${Math.random() * 1000}deg)`, opacity: 0 }
    ], {
      duration: Math.random() * 3000 + 2000,
      easing: 'cubic-bezier(0, .9, .57, 1)'
    });

    animation.onfinish = () => confetti.remove();
  }
}

function updateStep() {
  // Ocultar introdução suavemente após começar
  if (currentStep > 1 && sectionIntro) {
    sectionIntro.classList.add('hide');
  } else if (currentStep === 1 && sectionIntro) {
    sectionIntro.classList.remove('hide');
  }

  // Esconder todos os cards
  for(let i=1; i<=totalSteps; i++) {
    const card = document.getElementById('q'+i);
    if(card) {
      card.style.display = 'none';
      card.classList.remove('fade-in', 'shake');
    }
  }

  // Mostrar atual com animação
  const currentCard = document.getElementById('q'+currentStep);
  if(currentCard) {
    currentCard.style.display = 'block';
    currentCard.classList.add('fade-in');
    
    // Focar no card para acessibilidade
    currentCard.setAttribute('tabindex', '-1');
    currentCard.focus();
  }
  
  // Atualizar UI Header
  const stepLabel = document.getElementById('current-step');
  if(stepLabel) stepLabel.innerText = currentStep;
  
  // Barra de Progresso
  if(progressBar) {
    const progress = (currentStep / totalSteps) * 100;
    progressBar.style.width = progress + '%';
    
    if (progress < 40) progressBar.style.backgroundColor = '#e74c3c';
    else if (progress < 80) progressBar.style.backgroundColor = '#f1c40f';
    else progressBar.style.backgroundColor = '#009432';
  }
  
  // Botões
  if(prevBtn) prevBtn.style.display = currentStep > 1 ? 'block' : 'none';
  
  if (currentStep === totalSteps) {
    if(nextBtn) nextBtn.style.display = 'none';
    if(submitBtn) submitBtn.style.display = 'block';
  } else {
    if(nextBtn) nextBtn.style.display = 'block';
    if(submitBtn) submitBtn.style.display = 'none';
  }
  
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Feedback de Validação (Shake)
function triggerShake() {
  const currentCard = document.getElementById('q' + currentStep);
  if (currentCard) {
    currentCard.classList.remove('shake');
    void currentCard.offsetWidth; // Trigger reflow
    currentCard.classList.add('shake');
  }
}

if(nextBtn) {
  nextBtn.addEventListener('click', () => {
    const radios = document.getElementsByName('q' + currentStep);
    let selected = false;
    for (const r of radios) if (r.checked) selected = true;
    
    if (selected) {
      currentStep++;
      updateStep();
    } else {
      triggerShake();
    }
  });
}

if(prevBtn) {
  prevBtn.addEventListener('click', () => {
    currentStep--;
    updateStep();
  });
}

if(quizForm) {
  quizForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(quizForm);
    let counts = {1:0, 2:0, 3:0, 4:0};
    for(let val of formData.values()) counts[val]++;
    
    // Validar última questão se o usuário clicar direto no submit
    if (Object.values(counts).reduce((a,b) => a + b, 0) < totalSteps) {
      triggerShake();
      return;
    }

    quizForm.style.display = 'none';
    if(sectionIntro) sectionIntro.style.display = 'none';
    const resultado = document.getElementById('resultado-section');
    if(resultado) {
      resultado.style.display = 'block';
      resultado.classList.add('fade-in');
    }
    
    let top = Object.keys(counts).reduce((a, b) => counts[a] > counts[b] ? a : b);
    
    const results = {
      1: { title: "Enfermagem / Saúde", desc: "Seu perfil é voltado para o cuidado humano e assistência à saúde.", img: "https://images.unsplash.com/photo-1576765608596-78b53a3b7dc1?q=80&w=800" },
      2: { title: "Análise e Desenvolvimento de Sistemas", desc: "Você tem grande afinidade com lógica, tecnologia e inovação digital.", img: "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=800" },
      3: { title: "Gestão da Produção Industrial", desc: "Seu foco está na organização, eficiência de processos e liderança corporativa.", img: "https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=800" },
      4: { title: "Biotecnologia / Análises Clínicas", desc: "Você demonstra inclinação para o rigor científico, laboratórios e pesquisa.", img: "https://images.unsplash.com/photo-1579154204601-01588f351e67?q=80&w=800" }
    };
    
    const resultImg = document.getElementById('result-img');
    const resultTitle = document.getElementById('result-title');
    const resultDesc = document.getElementById('result-desc');

    if(resultImg) resultImg.style.backgroundImage = `url('${results[top].img}')`;
    
    // Efeito de celebração
    celebrate();
    
    // Aplicando efeito de digitação sequencial
    if(resultTitle) await typeWriter(resultTitle, results[top].title, 70);
    if(resultDesc) await typeWriter(resultDesc, results[top].desc, 30);
  });
}

// Inicialização
setupKeyboardShortcuts();
updateStep();
