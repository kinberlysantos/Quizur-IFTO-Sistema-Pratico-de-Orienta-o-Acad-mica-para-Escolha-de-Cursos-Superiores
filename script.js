let currentStep = 1;
const totalSteps = 10;

const nextBtn = document.getElementById('next-btn');
const prevBtn = document.getElementById('prev-btn');
const submitBtn = document.getElementById('submit-btn');
const quizForm = document.getElementById('quiz-form');
const progressBar = document.getElementById('progress-bar');

// 1. Auto-avanço e Feedback Visual
function setupAutoAdvance() {
  const allOptions = document.querySelectorAll('.option-card input[type="radio"]');
  allOptions.forEach(radio => {
    radio.addEventListener('change', () => {
      // Pequeno delay para o usuário ver a marcação antes de avançar
      if (currentStep < totalSteps) {
        setTimeout(() => {
          currentStep++;
          updateStep();
        }, 600);
      }
    });
  });
}

// 2. Efeito de Máquina de Escrever
function typeWriter(element, text, speed = 50) {
  element.textContent = ''; // Usar textContent para ser mais limpo
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

function updateStep() {
  // Esconder todos os cards
  for(let i=1; i<=totalSteps; i++) {
    const card = document.getElementById('q'+i);
    if(card) card.style.display = 'none';
  }
  // Mostrar atual
  const currentCard = document.getElementById('q'+currentStep);
  if(currentCard) currentCard.style.display = 'block';
  
  // Atualizar UI Header
  const stepLabel = document.getElementById('current-step');
  if(stepLabel) stepLabel.innerText = currentStep;
  
  // 3. Barra de Progresso Animada e Colorida
  if(progressBar) {
    const progress = (currentStep / totalSteps) * 100;
    progressBar.style.width = progress + '%';
    
    // Mudar cor conforme o progresso (Vermelho -> Amarelo -> Verde)
    if (progress < 40) {
      progressBar.style.backgroundColor = '#e74c3c'; // Vermelho
    } else if (progress < 80) {
      progressBar.style.backgroundColor = '#f1c40f'; // Amarelo
    } else {
      progressBar.style.backgroundColor = '#2ecc71'; // Verde
    }
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

if(nextBtn) {
  nextBtn.addEventListener('click', () => {
    const radios = document.getElementsByName('q' + currentStep);
    let selected = false;
    for (const r of radios) if (r.checked) selected = true;
    
    if (selected) {
      currentStep++;
      updateStep();
    } else {
      alert('Por favor, selecione uma opção antes de prosseguir.');
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
    quizForm.style.display = 'none';
    const sobre = document.getElementById('sobre');
    const resultado = document.getElementById('resultado-section');
    if(sobre) sobre.style.display = 'none';
    if(resultado) resultado.style.display = 'block';
    
    const formData = new FormData(quizForm);
    let counts = {A:0, B:0, C:0, D:0};
    for(let val of formData.values()) counts[val]++;
    
    let top = Object.keys(counts).reduce((a, b) => counts[a] > counts[b] ? a : b);
    
    const results = {
      A: { title: "Enfermagem / Saúde", desc: "Seu perfil é voltado para o cuidado humano e assistência à saúde.", img: "https://images.unsplash.com/photo-1576765608596-78b53a3b7dc1?q=80&w=800" },
      B: { title: "Análise e Desenvolvimento de Sistemas", desc: "Você tem grande afinidade com lógica, tecnologia e inovação digital.", img: "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=800" },
      C: { title: "Gestão da Produção Industrial", desc: "Seu foco está na organização, eficiência de processos e liderança corporativa.", img: "https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=800" },
      D: { title: "Biotecnologia / Análises Clínicas", desc: "Você demonstra inclinação para o rigor científico, laboratórios e pesquisa.", img: "https://images.unsplash.com/photo-1579154204601-01588f351e67?q=80&w=800" }
    };
    
    const resultImg = document.getElementById('result-img');
    const resultTitle = document.getElementById('result-title');
    const resultDesc = document.getElementById('result-desc');

    if(resultImg) resultImg.style.backgroundImage = `url('${results[top].img}')`;
    
    // Aplicando efeito de digitação sequencial
    if(resultTitle) await typeWriter(resultTitle, results[top].title, 70);
    if(resultDesc) await typeWriter(resultDesc, results[top].desc, 30);
  });
}

// Inicialização
setupAutoAdvance();
updateStep();
