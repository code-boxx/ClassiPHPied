var show = {
  // (A) DOWNLOAD IN PDF
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

  // (B) PRINT PAGE
  print : () => window.print()
};