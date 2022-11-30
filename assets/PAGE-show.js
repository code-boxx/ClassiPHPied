var show = {
  // (A) INITIALIZE
  init : () => { if (navigator.share) {
    document.getElementById("ad-share").classList.remove("d-none");
  }},

  // (B) DOWNLOAD IN PDF
  pdf : () => {
    if (typeof html2pdf == "undefined") {
      cb.loading(1);
      let s = document.createElement("script");
      s.src = cbhost.assets + "html2pdf.bundle.min.js";
      s.onload = () => {
        cb.loading(0);
        show.pdf();
      };
      document.head.appendChild(s);
    } else {
      html2pdf(document.getElementById("cb-page-1"));
    }
  },

  // (C) PRINT PAGE
  print : () => window.print(),

  // (D) SHARE PAGE
  share : () => navigator.share({
    title: document.title,
    text: document.querySelector("meta[name=description]").content,
    url: window.location.href
  })
};
window.addEventListener("load", show.init);