import { db } from './db.js';

/**
 * controller.js - Cérebro da Aplicação
 * Gerencia o fluxo do quiz, interação com o usuário e atualizações do DOM.
 */

const APP = {
  currentStep: 1,
  totalSteps: 10,
  respostas: {},
  
  // Elementos do DOM
  elements: {
    form: document.getElementById('quiz-form'),
    nextBtn: document.getElementById('next-btn'),
    prevBtn: document.getElementById('prev-btn'),
    submitBtn: document.getElementById('submit-btn'),
    progressBar: document.getElementById('progress-bar'),
    currentStepLabel: document.getElementById('current-step'),
    sectionIntro: document.getElementById('sobre'),
    resultadoSection: document.getElementById('resultado-section'),
    registroSection: document.getElementById('registro-section'),
    // Inputs de resultado
    resultTitle: document.getElementById('result-title'),
    resultDesc: document.getElementById('result-desc'),
    resultImg: document.getElementById('result-img')
  },

  async init() {
    console.log('Inicializando Controller...');
    this.setupListeners();
    this.setupKeyboardShortcuts();
    
    // Tenta recuperar progresso do banco
    const progressoSalvo = await db.obterProgresso();
    if (progressoSalvo) {
      this.currentStep = progressoSalvo.currentStep;
      this.respostas = progressoSalvo.respostas;
      this.aplicarRespostasSalvas();
    }
    
    this.updateUI();
  },

  setupListeners() {
    this.elements.nextBtn.addEventListener('click', () => this.nextStep());
    this.elements.prevBtn.addEventListener('click', () => this.prevStep());
    
    this.elements.form.addEventListener('submit', (e) => {
      e.preventDefault();
      this.finalizarQuiz();
    });

    // Monitorar mudanças nos rádios para salvar progresso automaticamente
    this.elements.form.addEventListener('change', (e) => {
      if (e.target.type === 'radio') {
        this.respostas[e.target.name] = e.target.value;
        db.salvarProgresso(this.currentStep, this.respostas);
      }
    });
  },

  aplicarRespostasSalvas() {
    Object.keys(this.respostas).forEach(name => {
      const value = this.respostas[name];
      const radio = this.elements.form.querySelector(`input[name="${name}"][value="${value}"]`);
      if (radio) radio.checked = true;
    });
  },

  async nextStep() {
    if (this.validarPassoAtual()) {
      if (this.currentStep < this.totalSteps) {
        this.currentStep++;
        this.updateUI();
        await db.salvarProgresso(this.currentStep, this.respostas);
      }
    } else {
      this.triggerShake();
    }
  },

  async prevStep() {
    if (this.currentStep > 1) {
      this.currentStep--;
      this.updateUI();
      await db.salvarProgresso(this.currentStep, this.respostas);
    }
  },

  validarPassoAtual() {
    const radios = document.getElementsByName('q' + this.currentStep);
    return Array.from(radios).some(r => r.checked);
  },

  updateUI() {
    // 1. Alternar visibilidade dos cards
    for (let i = 1; i <= this.totalSteps; i++) {
      const card = document.getElementById('q' + i);
      if (card) {
        card.style.display = (i === this.currentStep) ? 'block' : 'none';
        if (i === this.currentStep) card.classList.add('fade-in');
      }
    }

    // 2. Atualizar Progresso
    const progress = (this.currentStep / this.totalSteps) * 100;
    this.elements.progressBar.style.width = `${progress}%`;
    this.elements.currentStepLabel.innerText = this.currentStep;

    // 3. Controlar Botões
    this.elements.prevBtn.style.display = this.currentStep > 1 ? 'block' : 'none';
    
    if (this.currentStep === this.totalSteps) {
      this.elements.nextBtn.style.display = 'none';
      this.elements.submitBtn.style.display = 'block';
    } else {
      this.elements.nextBtn.style.display = 'block';
      this.elements.submitBtn.style.display = 'none';
    }

    // Ocultar intro após o passo 1
    if (this.currentStep > 1) this.elements.sectionIntro.classList.add('hide');
    else this.elements.sectionIntro.classList.remove('hide');

    window.scrollTo({ top: 0, behavior: 'smooth' });
  },

  async finalizarQuiz() {
    const formData = new FormData(this.elements.form);
    let counts = { 1: 0, 2: 0, 3: 0, 4: 0 };
    for (let val of formData.values()) counts[val]++;

    // Lógica de Resultado
    let top = Object.keys(counts).reduce((a, b) => counts[a] > counts[b] ? a : b);
    
    const resultsMap = {
      1: { title: "Enfermagem / Saúde", desc: "Seu perfil é voltado para o cuidado humano.", img: "https://images.unsplash.com/photo-1576765608596-78b53a3b7dc1?q=80&w=800" },
      2: { title: "Análise de Sistemas", desc: "Você tem afinidade com lógica e tecnologia.", img: "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=800" },
      3: { title: "Gestão Industrial", desc: "Foco em eficiência e processos.", img: "https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&w=800" },
      4: { title: "Biotecnologia", desc: "Inclinação para rigor científico e laboratório.", img: "https://images.unsplash.com/photo-1579154204601-01588f351e67?q=80&w=800" }
    };

    const finalResult = resultsMap[top];

    // Salvar no Banco
    await db.salvarResultado({ top, ...finalResult });
    await db.limparProgresso();

    // Atualizar UI para Resultado
    this.elements.form.style.display = 'none';
    this.elements.sectionIntro.style.display = 'none';
    this.elements.resultadoSection.style.display = 'block';
    this.elements.resultadoSection.classList.add('fade-in');
    
    this.elements.resultTitle.innerText = finalResult.title;
    this.elements.resultDesc.innerText = finalResult.desc;
    this.elements.resultImg.style.backgroundImage = `url('${finalResult.img}')`;
    
    // Exibe o formulário de registro após o resultado
    if (this.elements.registroSection) {
      this.elements.registroSection.style.display = 'block';
    }

    this.celebrate();
  },

  triggerShake() {
    const currentCard = document.getElementById('q' + this.currentStep);
    if (currentCard) {
      currentCard.classList.remove('shake');
      void currentCard.offsetWidth;
      currentCard.classList.add('shake');
    }
  },

  celebrate() {
    // Lógica de confetes simplificada
    console.log('Celebrando resultado!');
  },

  setupKeyboardShortcuts() {
    window.addEventListener('keydown', (e) => {
      if (['1','2','3','4'].includes(e.key)) {
        const radios = document.getElementsByName('q' + this.currentStep);
        if (radios[parseInt(e.key)-1]) radios[parseInt(e.key)-1].checked = true;
        this.elements.form.dispatchEvent(new Event('change', { bubbles: true }));
      }
      if (e.key === 'Enter') {
        e.preventDefault();
        this.elements.nextBtn.click();
      }
    });
  }
};

// Iniciar quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', () => APP.init());
