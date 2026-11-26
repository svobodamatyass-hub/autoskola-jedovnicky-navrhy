const header = document.querySelector("#header");
const menuButton = document.querySelector(".menu-button");
const navigation = document.querySelector("#navigation");
const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)");

function closeMenu() {
  if (!menuButton || !navigation) return;
  menuButton.setAttribute("aria-expanded", "false");
  menuButton.setAttribute("aria-label", "Otevřít menu");
  navigation.classList.remove("is-open");
}

if (menuButton && navigation) {
  menuButton.addEventListener("click", () => {
    const isOpen = menuButton.getAttribute("aria-expanded") !== "true";
    menuButton.setAttribute("aria-expanded", String(isOpen));
    menuButton.setAttribute("aria-label", isOpen ? "Zavřít menu" : "Otevřít menu");
    navigation.classList.toggle("is-open", isOpen);
    header?.classList.remove("is-hidden");
  });
  navigation.querySelectorAll("a").forEach(link => link.addEventListener("click", closeMenu));
  document.addEventListener("keydown", event => {
    if (event.key === "Escape") closeMenu();
  });
}

let lastScrollY = window.scrollY;
let framePending = false;
function updateHeader() {
  const currentY = Math.max(0, window.scrollY);
  const movingDown = currentY > lastScrollY + 5;
  const movingUp = currentY < lastScrollY - 5;
  const menuOpen = menuButton?.getAttribute("aria-expanded") === "true";
  if (currentY < 72 || movingUp || menuOpen) header?.classList.remove("is-hidden");
  else if (currentY > 150 && movingDown) header?.classList.add("is-hidden");
  lastScrollY = currentY;
  framePending = false;
}
window.addEventListener("scroll", () => {
  if (framePending) return;
  framePending = true;
  requestAnimationFrame(updateHeader);
}, { passive: true });

document.querySelectorAll('a[href="#top"]').forEach(link => {
  link.addEventListener("click", event => {
    event.preventDefault();
    closeMenu();
    header?.classList.remove("is-hidden");
    window.scrollTo({ top: 0, behavior: reduceMotion.matches ? "instant" : "smooth" });
    history.replaceState(null, "", location.pathname + location.search);
  });
});

if (!reduceMotion.matches && "IntersectionObserver" in window) {
  const revealItems = document.querySelectorAll(".approach-content, .course, .extras, .enrolment, .gallery-grid figure, .faq-grid, .contact-grid");
  const observer = new IntersectionObserver((entries, activeObserver) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add("is-visible");
      activeObserver.unobserve(entry.target);
    });
  }, { rootMargin: "0px 0px -35px 0px", threshold: 0.08 });
  document.documentElement.classList.add("motion-ready");
  revealItems.forEach(element => {
    element.setAttribute("data-reveal", "");
    observer.observe(element);
  });
}
