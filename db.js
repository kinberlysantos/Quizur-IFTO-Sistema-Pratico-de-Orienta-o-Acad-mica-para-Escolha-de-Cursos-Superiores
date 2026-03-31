/**
 * db.js - Camada de Persistência (IndexedDB)
 * Responsável exclusivamente por operações de leitura e escrita no banco de dados local.
 */

const DB_NAME = 'QuizurDB';
const DB_VERSION = 1;
const STORES = {
  PROGRESSO: 'progresso',
  RESULTADOS: 'resultados'
};

export const db = {
  _db: null,

  async open() {
    if (this._db) return this._db;

    return new Promise((resolve, reject) => {
      const request = indexedDB.open(DB_NAME, DB_VERSION);

      request.onupgradeneeded = (event) => {
        const db = event.target.result;
        // Store para progresso atual (apenas 1 registro)
        if (!db.objectStoreNames.contains(STORES.PROGRESSO)) {
          db.createObjectStore(STORES.PROGRESSO, { keyPath: 'id' });
        }
        // Store para histórico de resultados
        if (!db.objectStoreNames.contains(STORES.RESULTADOS)) {
          db.createObjectStore(STORES.RESULTADOS, { keyPath: 'timestamp' });
        }
      };

      request.onsuccess = (event) => {
        this._db = event.target.result;
        resolve(this._db);
      };

      request.onerror = (event) => reject('Erro ao abrir IndexedDB: ' + event.target.error);
    });
  },

  async salvarProgresso(currentStep, respostas) {
    const database = await this.open();
    return new Promise((resolve, reject) => {
      const transaction = database.transaction([STORES.PROGRESSO], 'readwrite');
      const store = transaction.objectStore(STORES.PROGRESSO);
      const request = store.put({ id: 'atual', currentStep, respostas });

      request.onsuccess = () => resolve();
      request.onerror = () => reject('Erro ao salvar progresso');
    });
  },

  async obterProgresso() {
    const database = await this.open();
    return new Promise((resolve) => {
      const transaction = database.transaction([STORES.PROGRESSO], 'readonly');
      const store = transaction.objectStore(STORES.PROGRESSO);
      const request = store.get('atual');

      request.onsuccess = () => resolve(request.result);
      request.onerror = () => resolve(null);
    });
  },

  async limparProgresso() {
    const database = await this.open();
    const transaction = database.transaction([STORES.PROGRESSO], 'readwrite');
    transaction.objectStore(STORES.PROGRESSO).delete('atual');
  },

  async salvarResultado(resultado) {
    const database = await this.open();
    return new Promise((resolve) => {
      const transaction = database.transaction([STORES.RESULTADOS], 'readwrite');
      const store = transaction.objectStore(STORES.RESULTADOS);
      store.add({ ...resultado, timestamp: Date.now() });
      resolve();
    });
  }
};
