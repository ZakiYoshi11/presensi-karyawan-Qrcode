<!-- Kode HTML untuk mengaktifkan kamera -->
<video id="video" width="640" height="480" autoplay></video>

<!-- Skrip JavaScript untuk mengaktifkan kamera -->
<script>
  // Ambil elemen video
  const video = document.getElementById("video");

  // Ambil media stream dari kamera
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function(stream) {
      video.srcObject = stream;
    })
    .catch(function(error) {
      console.error("Error:", error);
    });
</script>

<!-- Tombol untuk membaca QR code -->
<button id="btn-scan">Scan QR Code</button>

<!-- Skrip JavaScript untuk membaca QR code -->
<script>
  // Ambil tombol scan
  const btnScan = document.getElementById("btn-scan");

  // Buat objek QR code reader
  const qrcode = new QRCodeReader();

  btnScan.addEventListener("click", function() {
// Ambil gambar dari video
const canvas = document.createElement("canvas");
canvas.width = video.videoWidth;
canvas.height = video.videoHeight;
canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);

// Baca QR code dari gambar
qrcode.decode(canvas.toDataURL("image/png"))
.then(function(result) {
alert("Hasil scan QR code: " + result);
})
.catch(function(error) {
console.error("Error:", error);
alert("Tidak dapat membaca QR code");
});
});

</script>
