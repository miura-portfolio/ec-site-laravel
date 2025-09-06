/**
 * 共通フロントスクリプト
 * 機能:
 *  - フラッシュ/アラートの自動消去(3秒)
 *  - いいね(♥)トグル: 楽観的UI → 失敗時ロールバック
 *  - 削除の確認ダイアログ
 *  - ファイル選択のクリア
 * 前提:
 *  - <meta name="csrf-token" content="..."> が存在
 */

document.addEventListener("DOMContentLoaded", () => {
  // --- フラッシュ/アラート自動消去 ---
  const msgs = document.querySelectorAll(".alert, .flash-message");
  msgs.forEach((el) => {
    setTimeout(() => {
      el.style.display = "none";
    }, 3000);
  });

  // --- いいね(♥)トグル ---
  document.querySelectorAll("form.like-form .heart-btn").forEach((btn) => {
    btn.addEventListener("click", async function (e) {
      e.preventDefault(); // 既定のフォーム送信は止める
      const form = this.closest("form");
      const pressed = this.getAttribute("aria-pressed") === "true";

      // 楽観的にUIを先に切替
      this.setAttribute("aria-pressed", String(!pressed));
      this.title = pressed ? "お気に入りに追加" : "お気に入り解除";
      this.disabled = true;

      try {
        const res = await fetch(form.action, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document
              .querySelector('meta[name="csrf-token"]')
              .getAttribute("content"),
          },
          body: JSON.stringify({ like: !pressed }),
        });

        if (!res.ok) throw new Error(`like failed: ${res.status}`);
      } catch (err) {
        // 失敗時は元に戻す
        this.setAttribute("aria-pressed", String(pressed));
        this.title = pressed ? "お気に入り解除" : "お気に入りに追加";
        console.error(err);
        alert("いいね処理に失敗しました");
      } finally {
        this.disabled = false;
      }
    });
  });

  // --- 削除の確認ダイアログ ---
  document.querySelectorAll(".js-delete-form").forEach((form) => {
    form.addEventListener("submit", (e) => {
      const ok = window.confirm(
        "本当に削除しますか？この操作は取り消せません。"
      );
      if (!ok) e.preventDefault();
    });
  });
});

// --- ファイル選択クリア（動的に拾うため委譲で実装） ---
document.addEventListener("click", (e) => {
  const btn = e.target.closest(".js-clear-file");
  if (!btn) return;

  const selector = btn.getAttribute("data-target");
  if (!selector) return;

  const input = document.querySelector(selector);
  if (input && input.type === "file") {
    input.value = ""; // クリア
    // 同じファイルを再選択できるように change を発火
    const ev = new Event("change", { bubbles: true });
    input.dispatchEvent(ev);
  }
});
