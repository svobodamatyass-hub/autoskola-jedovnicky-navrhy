const header = document.querySelector(".site-header");
const menuButton = document.querySelector(".menu-toggle");
const navigation = document.querySelector(".main-nav");
const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");

function closeMenu() {
  if (!menuButton || !navigation) return;
  menuButton.setAttribute("aria-expanded", "false");
  menuButton.setAttribute("aria-label", "Otevřít menu");
  navigation.classList.remove("is-open");
}

if (menuButton && navigation) {
  menuButton.addEventListener("click", () => {
    const open = menuButton.getAttribute("aria-expanded") !== "true";
    menuButton.setAttribute("aria-expanded", String(open));
    menuButton.setAttribute("aria-label", open ? "Zavřít menu" : "Otevřít menu");
    navigation.classList.toggle("is-open", open);
    header?.classList.remove("is-hidden");
  });
  navigation.querySelectorAll("a").forEach(link => link.addEventListener("click", closeMenu));
  document.addEventListener("keydown", event => {
    if (event.key === "Escape") closeMenu();
  });
}

// Navigation is available on entry and returns when scrolling upward.
let previousY = Math.max(0, window.scrollY);
let scrollQueued = false;
function updateHeader() {
  if (!header) return;
  const y = Math.max(0, window.scrollY);
  const delta = y - previousY;
  const menuOpen = menuButton?.getAttribute("aria-expanded") === "true";
  if (y < 80 || menuOpen || delta < -5) header.classList.remove("is-hidden");
  else if (y > 140 && delta > 5) header.classList.add("is-hidden");
  if (Math.abs(delta) > 5 || y < 80) previousY = y;
  scrollQueued = false;
}
window.addEventListener("scroll", () => {
  if (scrollQueued) return;
  scrollQueued = true;
  window.requestAnimationFrame(updateHeader);
}, { passive: true });

document.querySelectorAll('a[href$="#top"]').forEach(link => {
  link.addEventListener("click", event => {
    const destination = new URL(link.href, location.href);
    if (destination.origin !== location.origin || destination.pathname.replace(/\/$/, "") !== location.pathname.replace(/\/$/, "")) return;
    event.preventDefault();
    closeMenu();
    header?.classList.remove("is-hidden");
    window.scrollTo({ top: 0, behavior: reducedMotion.matches ? "instant" : "smooth" });
    history.replaceState(null, "", location.pathname + location.search);
  });
});


// Subtle progressive scroll reveals. Content stays visible without JavaScript.
if (!reducedMotion.matches && "IntersectionObserver" in window) {
  const revealGroups = [
    [".approach-grid > *", 80],
    [".courses .section-head", 0],
    [".course-grid > *", 90],
    [".extras > *", 80],
    [".installments", 0],
    [".steps .section-head", 0],
    [".steps-grid > *", 90],
    [".steps .button", 0],
    [".gallery .section-head", 0],
    [".gallery-grid > *", 90],
    [".faq-grid > *", 80],
    [".contact-grid > *", 100]
  ];
  const revealItems = [];
  for (const [selector, stagger] of revealGroups) {
    document.querySelectorAll(selector).forEach((element, index) => {
      element.classList.add("reveal-item");
      element.style.setProperty("--reveal-delay", `${Math.min(index * stagger, 180)}ms`);
      revealItems.push(element);
    });
  }
  const remaining = new Set(revealItems);
  let observer;
  function revealInViewport() {
    const visibleLimit = window.innerHeight - 24;
    for (const element of remaining) {
      const bounds = element.getBoundingClientRect();
      if (bounds.top >= visibleLimit || bounds.bottom <= 0) continue;
      element.classList.add("is-visible");
      observer?.unobserve(element);
      remaining.delete(element);
    }
    if (remaining.size === 0) {
      window.removeEventListener("scroll", revealInViewport);
      window.removeEventListener("resize", revealInViewport);
    }
  }
  observer = new IntersectionObserver((entries, activeObserver) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add("is-visible");
      remaining.delete(entry.target);
      activeObserver.unobserve(entry.target);
    });
  }, { rootMargin: "0px 0px -32px 0px", threshold: 0.06 });
  document.documentElement.classList.add("motion-ready");
  revealItems.forEach(element => observer.observe(element));
  window.addEventListener("scroll", revealInViewport, { passive: true });
  window.addEventListener("resize", revealInViewport);
  revealInViewport();
}
