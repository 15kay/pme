// Navbar Import
fetch('../headers/nav.html')
  .then(res => res.text())
  .then(data => {
    const navbar = document.getElementById('navbar');
    if (navbar) {
      navbar.innerHTML = data;

      // Highlight current page
      const links = document.querySelectorAll('.nav-link');
      links.forEach(link => {
        if (link.href === window.location.href) {
          link.classList.add('active');
        }
      });
    }
  });

// Loader
window.addEventListener("load", function () {
  const loader = document.getElementById("loader");
  if (loader) {
    loader.style.opacity = "0";
    loader.style.pointerEvents = "none";
    setTimeout(() => loader.style.display = "none", 500);
  }
});

document.addEventListener("DOMContentLoaded", function () {
  // Mobile Menu Toggle
  const hamburger = document.getElementById("hamburger");
  const sidebar = document.getElementById("sidebar");

  hamburger?.addEventListener("click", () => {
    sidebar?.classList.toggle("show");
    hamburger.classList.toggle("active");
    const expanded = hamburger.getAttribute("aria-expanded") === "true";
    hamburger.setAttribute("aria-expanded", String(!expanded));
  });

  window.addEventListener("click", (e) => {
    if (
      sidebar?.classList.contains("show") &&
      !sidebar.contains(e.target) &&
      !hamburger.contains(e.target)
    ) {
      sidebar.classList.remove("show");
      hamburger.classList.remove("active");
      hamburger.setAttribute("aria-expanded", "false");
    }
  });

  // Search Highlight & Navigation
  const input = document.querySelector("#searchInput");
  const resultsContainer = document.getElementById("searchResults");

  if (input && resultsContainer) {
    let currentIndex = 0;
    let matches = [];

    function removeHighlights() {
      document.querySelectorAll(".highlight-search").forEach(span => {
        const parent = span.parentNode;
        parent.replaceChild(document.createTextNode(span.textContent), span);
        parent.normalize();
      });
      matches = [];
      resultsContainer.innerHTML = "";
    }

    function highlightMatches(term) {
      removeHighlights();
      if (!term) return;

      const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
      const regex = new RegExp(term, "gi");

      while (walker.nextNode()) {
        const node = walker.currentNode;
        if (
          node.nodeValue &&
          !node.parentElement.closest("script, style, svg, head, title, noscript, input, textarea, .search-form")
        ) {
          const text = node.nodeValue;
          if (regex.test(text)) {
            const spanWrap = document.createElement("span");
            const newText = text.replace(regex, match => `<span class="highlight-search">${match}</span>`);
            spanWrap.innerHTML = newText;
            node.parentNode.replaceChild(spanWrap, node);
          }
        }
      }

      matches = Array.from(document.querySelectorAll(".highlight-search"));
      updateResultsDisplay();
    }

    function updateResultsDisplay() {
      if (matches.length === 0) {
        resultsContainer.innerHTML = "<div>No results found.</div>";
        return;
      }

      currentIndex = 0;
      scrollToMatch(currentIndex);

      resultsContainer.innerHTML = `
        <div class="results-status">
          <span>Match <strong id="currentIndex">${currentIndex + 1}</strong> of <strong id="totalResults">${matches.length}</strong></span>
          <button onclick="navigateSearch(-1)">↑</button>
          <button onclick="navigateSearch(1)">↓</button>
        </div>
      `;
    }

    function scrollToMatch(index) {
      matches.forEach(m => m.classList.remove("current-match"));

      if (matches[index]) {
        matches[index].classList.add("current-match");
        const offset = matches[index].getBoundingClientRect().top + window.scrollY - 100;
        window.scrollTo({ top: offset, behavior: "smooth" });
      }

      const counter = document.getElementById("currentIndex");
      if (counter) counter.textContent = index + 1;
    }

    window.navigateSearch = (direction) => {
      if (!matches.length) return;
      currentIndex = (currentIndex + direction + matches.length) % matches.length;
      scrollToMatch(currentIndex);
    };

    input.addEventListener("input", () => {
      const term = input.value.trim();
      highlightMatches(term);
    });

    input.addEventListener("keydown", e => {
      if (e.key === "ArrowDown") {
        e.preventDefault();
        navigateSearch(1);
      } else if (e.key === "ArrowUp") {
        e.preventDefault();
        navigateSearch(-1);
      }
    });
  }
});
