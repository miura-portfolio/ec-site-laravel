document.addEventListener("DOMContentLoaded", function () {
  // 3秒でアラートを消す処理
  const messages = document.querySelectorAll('.alert');
  messages.forEach(msg => {
    setTimeout(() => { msg.style.display = 'none'; }, 3000);
  });

  // いいね（♥）トグル
  document.querySelectorAll('form.like-form .heart-btn').forEach((btn) => {
    btn.addEventListener('click', async function (e) {
      e.preventDefault(); // フォーム送信は止める

      const form = this.closest('form');
      const pressed = this.getAttribute('aria-pressed') === 'true';

      // UIを先に切替
      this.setAttribute('aria-pressed', String(!pressed));
      this.title = pressed ? 'お気に入りに追加' : 'お気に入り解除';

      try {
        const res = await fetch(form.action, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify({ like: !pressed })
        });
        if (!res.ok) throw new Error('like failed');
      } catch (err) {
        // 失敗時は元に戻す
        this.setAttribute('aria-pressed', String(pressed));
        this.title = pressed ? 'お気に入り解除' : 'お気に入りに追加';
        console.error(err);
        alert('いいね処理に失敗しました');
      }
    });
  });

  // ★ 削除の確認ダイアログ
  document.querySelectorAll('.js-delete-form').forEach((form) => {
    form.addEventListener('submit', function (e) {
      const ok = window.confirm('本当に削除しますか？この操作は取り消せません。');
      if (!ok) e.preventDefault();
    });
  });
});

// === ファイル選択クリア ===
document.addEventListener('click', (e) => {
  const btn = e.target.closest('.js-clear-file');
  if (!btn) return;
  const selector = btn.getAttribute('data-target');
  if (!selector) return;

  const input = document.querySelector(selector);
  if (input && input.type === 'file') {
    // ファイル input の value を空に
    input.value = '';
    // 同じファイルを再選択できるように change イベントも発火（任意）
    const ev = new Event('change', { bubbles: true });
    input.dispatchEvent(ev);
  }
});
