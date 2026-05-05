<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizur IFTO - Orientação Acadêmica</title>
  <link rel="icon" type="image/png" href="logo.png">
  <link rel="stylesheet" href="styles.css">
  <style>
    .hidden { display: none; }
    .question-card { display: none; }
    .question-card.active { display: block; }
  </style>
</head>
<body>

<header class="header-container">
  <div class="header-content">
    <div class="logo"><img src="logo.png" alt="Quizur IFTO Logo" style="height: 40px; vertical-align: middle; margin-right: 10px;">Quizur IFTO</div>
    <div class="progress-info">Questão <span id="current-step">1</span> de 10</div>
  </div>
  <div class="progress-bar-container">
    <div class="progress-bar-fill" id="progress-bar" style="width: 10%;"></div>
  </div>
</header>

<main class="main-container">

  <?php if (isset($resultado) && !isset($resultado['error'])): ?>
    <!-- RESULTADO -->
    <section id="resultado-section" class="fade-in">
      <article class="question-card active">
        <div class="question-image" style="background-image: url('<?= $resultado['img'] ?>');"></div>
        <div class="question-body">
          <span class="category-label">Resultado do Perfil</span>
          <h3 class="question-text"><?= $resultado['title'] ?></h3>
          <p style="margin-bottom: 1.5rem; color: var(--neutral-gray);"><?= $resultado['desc'] ?></p>
        </div>
      </article>

      <article class="question-card active" style="margin-top: 2rem; padding: 2rem;">
        <h2 style="margin-bottom: 1rem;">Interessado neste curso?</h2>
        <form action="index.php/registrar" method="POST" class="options-group">
          <input type="hidden" name="curso" value="<?= $resultado['title'] ?>">
          <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: 700; margin-bottom: 0.5rem;">Nome Completo</label>
            <input type="text" name="nome" required style="width: 100%; padding: 0.75rem; border: 2px solid var(--borders); border-radius: var(--radius-md);">
          </div>
          <div style="margin-bottom: 1rem;">
            <label style="display:block; font-weight: 700; margin-bottom: 0.5rem;">E-mail</label>
            <input type="email" name="email" required style="width: 100%; padding: 0.75rem; border: 2px solid var(--borders); border-radius: var(--radius-md);">
          </div>
          <button type="submit" class="btn-next">Enviar e Acessar Portal</button>
        </form>
      </article>
    </section>
  <?php else: ?>
    <!-- QUIZ -->
    <section id="sobre" class="section-intro">
      <h2>Orientação Acadêmica</h2>
      <p>Descubra qual curso do IFTO Campus Araguaína combina com você.</p>
    </section>

    <form id="quiz-form" action="index.php/finalizar" method="POST">
      <?php for ($i = 1; $i <= 10; $i++): ?>
        <article class="question-card <?= $i === 1 ? 'active' : '' ?>" id="q<?= $i ?>">
          <div class="question-body">
            <span class="category-label">Questão <?= $i ?></span>
            <h3 class="question-text">
              <?php
                $perguntas = [
                  1 => "Qual área mais desperta seu interesse?",
                  2 => "Você prefere trabalhar:",
                  3 => "Seu perfil comportamental é mais:",
                  4 => "Você gosta de atividades que envolvem:",
                  5 => "Prefere resolver problemas relacionados a:",
                  6 => "Seu ambiente ideal de trabalho seria:",
                  7 => "Você prefere atividades predominantemente:",
                  8 => "Seu objetivo profissional principal é:",
                  9 => "Com qual dessas ferramentas você se identifica mais?",
                  10 => "Como você se vê daqui a 5 anos?"
                ];
                echo $perguntas[$i];
              ?>
            </h3>
            <div class="options-group">
              <?php 
                $opcoes = [
                  1 => ["Saúde", "Tecnologia", "Gestão", "Ciência"],
                  2 => ["Pessoas", "Sistemas", "Processos", "Análises"],
                  3 => ["Empático", "Investigativo", "Líder", "Analítico"],
                  4 => ["Clínica", "Software", "Indústria", "Laboratório"],
                  5 => ["Bem-estar", "Automação", "Produtividade", "Qualidade"],
                  6 => ["Hospital", "Tech/Home", "Indústria", "Laboratório"],
                  7 => ["Humanizadas", "Lógicas", "Estratégicas", "Técnicas"],
                  8 => ["Pacientes", "Inovação", "Otimização", "Diagnóstico"],
                  9 => ["Estetoscópio", "Computador", "Planilha", "Microscópio"],
                  10 => ["Saúde", "Software", "Gestão", "Diagnóstico"]
                ];
                foreach ($opcoes[$i] as $idx => $label): 
              ?>
                <label class="option-card">
                  <input type="radio" name="q<?= $i ?>" value="<?= $idx + 1 ?>" required>
                  <span class="option-number"><?= $idx + 1 ?></span>
                  <span class="option-text"><?= $label ?></span>
                </label>
              <?php endforeach; ?>
            </div>
          </div>
        </article>
      <?php endfor; ?>

      <div class="nav-buttons">
        <button type="button" class="btn-prev" id="btn-prev" style="display: none;">Voltar</button>
        <button type="button" class="btn-next" id="btn-next">Próxima</button>
        <button type="submit" class="btn-next" id="btn-submit" style="display: none;">Ver Resultado</button>
      </div>
    </form>
  <?php endif; ?>

</main>

<footer>
  <p><strong>Instituto Federal do Tocantins - Campus Araguaína</strong><br>
  © 2026 - Sistema de Orientação Acadêmica</p>
</footer>

<script>
  // Script minimalista apenas para navegação entre passos (View)
  let currentStep = 1;
  const totalSteps = 10;
  
  const btnNext = document.getElementById('btn-next');
  const btnPrev = document.getElementById('btn-prev');
  const btnSubmit = document.getElementById('btn-submit');
  const progress = document.getElementById('progress-bar');
  const stepLabel = document.getElementById('current-step');

  function updateView() {
    document.querySelectorAll('.question-card').forEach((card, i) => {
      card.classList.toggle('active', (i + 1) === currentStep);
    });
    
    btnPrev.style.display = currentStep > 1 ? 'block' : 'none';
    btnNext.style.display = currentStep < totalSteps ? 'block' : 'none';
    btnSubmit.style.display = currentStep === totalSteps ? 'block' : 'none';
    
    progress.style.width = (currentStep / totalSteps * 100) + '%';
    stepLabel.innerText = currentStep;
  }

  btnNext?.addEventListener('click', () => {
    const radios = document.getElementsByName('q' + currentStep);
    if (Array.from(radios).some(r => r.checked)) {
      currentStep++;
      updateView();
    } else {
      alert('Selecione uma opção!');
    }
  });

  btnPrev?.addEventListener('click', () => {
    currentStep--;
    updateView();
  });
</script>

</body>
</html>
