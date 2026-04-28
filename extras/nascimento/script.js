const MS_PER_DAY = 24 * 60 * 60 * 1000;
const slider = document.getElementById('dateSlider');
const display = document.getElementById('display');
const manualInput = document.getElementById('manualInput');
const inputStatus = document.getElementById('inputStatus');
const saveBtn = document.getElementById('saveBtn');
const saveStatus = document.getElementById('saveStatus');
const actionsArea = document.querySelector('.actions-area');
const today = new Date();
const startDate = new Date(1900, 0, 1);
let db;
let sabotageTimerId;

const request = indexedDB.open('TraumaDB', 1);

request.onupgradeneeded = (event) => {
  db = event.target.result;

  if (!db.objectStoreNames.contains('birthdates')) {
    db.createObjectStore('birthdates', { autoIncrement: true });
  }
};

request.onsuccess = (event) => {
  db = event.target.result;
  saveStatus.textContent = 'Banco pronto. O sistema agora pode registrar seu sofrimento.';
};

request.onerror = () => {
  saveStatus.textContent = 'Falha ao abrir o IndexedDB. Ate o caos tem limites.';
};

function clampSliderToToday(rawValue) {
  const proposedDate = new Date(startDate.getTime() + rawValue * MS_PER_DAY);
  if (proposedDate > today) {
    const diff = Math.floor((today.getTime() - startDate.getTime()) / MS_PER_DAY);
    return diff;
  }

  return rawValue;
}

function formatDateFromSlider() {
  const normalizedValue = clampSliderToToday(Number(slider.value));
  if (normalizedValue !== Number(slider.value)) {
    slider.value = String(normalizedValue);
  }

  const targetDate = new Date(startDate.getTime() + normalizedValue * MS_PER_DAY);
  display.textContent = targetDate.toLocaleDateString('pt-BR');
  return targetDate;
}

function schedulePassiveAggressiveValidation() {
  window.clearTimeout(sabotageTimerId);
  inputStatus.textContent = 'Contagem regressiva iniciada. Nao pense demais.';

  sabotageTimerId = window.setTimeout(() => {
    manualInput.value = 'Lento demais!';
    inputStatus.textContent = 'Voce hesitou e o campo decidiu julgar voce.';

    window.setTimeout(() => {
      manualInput.value = '';
      inputStatus.textContent = 'Campo limpo. Tente novamente, mas com mais desespero.';
    }, 500);
  }, 3000);
}

function moveButton() {
  const areaRect = actionsArea.getBoundingClientRect();
  const buttonRect = saveBtn.getBoundingClientRect();
  const maxLeft = Math.max(0, areaRect.width - buttonRect.width);
  const maxTop = Math.max(0, areaRect.height - buttonRect.height);
  const nextLeft = Math.random() * maxLeft;
  const nextTop = Math.random() * maxTop;

  saveBtn.style.left = `${nextLeft}px`;
  saveBtn.style.top = `${nextTop}px`;
}

function saveBirthdate() {
  if (!db) {
    saveStatus.textContent = 'O banco ainda nao acordou. Tente de novo em um instante.';
    return;
  }

  const transaction = db.transaction(['birthdates'], 'readwrite');
  const store = transaction.objectStore('birthdates');
  const data = {
    data_gerada: display.textContent,
    input_manual: manualInput.value,
    valor_slider: Number(slider.value),
    timestamp: new Date().toISOString()
  };

  const addRequest = store.add(data);

  addRequest.onsuccess = () => {
    saveStatus.textContent = `Incrivel! Voce venceu o sistema e salvou ${data.data_gerada}.`;
    window.alert('Incrivel! Voce venceu o sistema.');
  };

  addRequest.onerror = () => {
    saveStatus.textContent = 'Nem o IndexedDB quis participar dessa decisao.';
  };
}

slider.addEventListener('input', formatDateFromSlider);
manualInput.addEventListener('input', schedulePassiveAggressiveValidation);
manualInput.addEventListener('focus', schedulePassiveAggressiveValidation);
saveBtn.addEventListener('mouseover', moveButton);
saveBtn.addEventListener('focus', moveButton);
saveBtn.addEventListener('click', saveBirthdate);

formatDateFromSlider();
