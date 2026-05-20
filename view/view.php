<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quizur IFTO - Orientação Acadêmica</title>
  <link rel="icon" type="image/png" href="logo.png">
  <link rel="stylesheet" href="assets/css/styles.css">
  <style>
    .hidden { display: none; }
    .question-card { display: none; }
    .question-card.active { display: block; }
  </style>
</head>
<body>

<header class="header-container">
  <div class="header-content">
    <div class="logo"><img src="view/images/logo.png" alt="Quizur IFTO Logo" style="height: 40px; vertical-align: middle; margin-right: 10px;">Quizur IFTO</div>
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
      <?php 
        $perguntas = [
          1 => [
            "text" => "Qual área mais desperta seu interesse?",
            "img" => "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800",
            "opcoes" => ["Saúde", "Tecnologia", "Gestão", "Ciência"]
          ],
          2 => [
            "text" => "Você prefere trabalhar:",
            "img" => "https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=800",
            "opcoes" => ["Pessoas", "Sistemas", "Processos", "Análises"]
          ],
          3 => [
            "text" => "Seu perfil comportamental é mais:",
            "img" => "https://images.unsplash.com/photo-1454165833767-027ffea9e77b?q=80&w=800",
            "opcoes" => ["Empático", "Investigativo", "Líder", "Analítico"]
          ],
          4 => [
            "text" => "Você gosta de atividades que envolvem:",
            "img" => "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=800",
            "opcoes" => ["Clínica", "Software", "Indústria", "Laboratório"]
          ],
          5 => [
            "text" => "Prefere resolver problemas relacionados a:",
            "img" => "https://images.unsplash.com/photo-1507413245164-6160d8298b31?q=80&w=800",
            "opcoes" => ["Bem-estar", "Automação", "Produtividade", "Qualidade"]
          ],
          6 => [
            "text" => "Seu ambiente ideal de trabalho seria:",
            "img" => "https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=800",
            "opcoes" => ["Hospital", "Tech/Home", "Indústria", "Laboratório"]
          ],
          7 => [
            "text" => "Você prefere atividades predominantemente:",
            "img" => "https://images.unsplash.com/photo-1551288049-bbbda540d379?q=80&w=800",
            "opcoes" => ["Humanizadas", "Lógicas", "Estratégicas", "Técnicas"]
          ],
          8 => [
            "text" => "Seu objetivo profissional principal é:",
            "img" => "https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=800",
            "opcoes" => ["Pacientes", "Inovação", "Otimização", "Diagnóstico"]
          ],
          9 => [
            "text" => "Com qual dessas ferramentas você se identifica mais?",
            "img" => "https://images.unsplash.com/photo-1576086213369-97a306d36557?q=80&w=800",
            "opcoes" => ["Estetoscópio", "Computador", "Planilha", "Microscópio"]
          ],
          10 => [
            "text" => "Como você se vê daqui a 5 anos?",
            "img" => "https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=800",
            "opcoes" => ["Saúde", "Software", "Gestão", "Diagnóstico"]
          ]
        ];

        for ($i = 1; $i <= 10; $i++): 
          $q = $perguntas[$i];
      ?>
        <article class="question-card <?= $i === 1 ? 'active' : '' ?>" id="q<?= $i ?>">
          <div class="question-image" style="background-image: url('<?= $q['img'] ?>');"></div>
          <div class="question-body">
            <span class="category-label">Questão <?= $i ?></span>
            <h3 class="question-text"><?= $q['text'] ?></h3>
            <div class="options-group">
              <?php foreach ($q['opcoes'] as $idx => $label): ?>
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
l>
