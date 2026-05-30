// Konfirmasi sebelum hapus
function confirmDelete(url) {
  if (confirm("Yakin ingin menghapus data ini?")) {
    window.location.href = url;
  }
}

// Format angka ke Rupiah (frontend)
function formatRupiah(angka) {
  let number_string = angka.toString().replace(/[^,\d]/g, ""),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    let separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
  return "Rp " + rupiah;
}

// Highlight menu aktif di sidebar
document.addEventListener("DOMContentLoaded", function () {
  const links = document.querySelectorAll(".sidebar a");
  if (links && links.length > 0) {
    links.forEach(link => {
      if (link.href === window.location.href) {
        link.style.backgroundColor = "#1abc9c";
      }
    });
  }
});

// Toggle sidebar (responsive)
function toggleSidebar() {
  const sidebar = document.querySelector(".sidebar");
  if (sidebar) sidebar.classList.toggle("active");
}
