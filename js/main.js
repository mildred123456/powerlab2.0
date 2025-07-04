
  document.addEventListener("DOMContentLoaded", () => {
    // 1. Cambia el título al pasar el ratón
    const titulo = document.querySelector(".main-title");
    titulo.addEventListener("mouseenter", () => {
      titulo.textContent = "¡Descubre tu mejor versión!";
    });
    titulo.addEventListener("mouseleave", () => {
      titulo.textContent = "Elige tu Camino en FlowFit";
    });
  
  
    window.addEventListener("load", () => {
        const loader = document.getElementById("loader");
        if (loader) {
          loader.style.opacity = "1";
          loader.style.transition = "opacity 0.5s ease-out";
          setTimeout(() => {
            loader.style.transition = "opacity 0.5s ease-out, visibility 0.5s";
            loader.style.opacity = "0";
            loader.style.visibility = "hidden";
            setTimeout(() => loader.remove(), 500); // lo elimina completamente del DOM
          }, 500);
        }
      });
      
  

    });
  