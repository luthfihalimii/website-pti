<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="UTF-8">
<title>{{ $title ?? __('Flipbook') }} | {{ __('Viewer') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
@vite(['resources/css/app.css'])

</head>
<body class="flipbook-page">

<!-- TOPBAR -->
<div class="flipbook-topbar">
  <div class="flipbook-brand">
    <a class="flipbook-btn" href="{{ route('publications.index') }}">← {{ __('Kembali') }}</a>
    <span class="flipbook-title">{{ $title ?? __('Flipbook') }}</span>
  </div>

  <div class="flipbook-actions">
    <button class="flipbook-btn" id="prevBtn" onclick="prevSpread()">⟵ {{ __('Sebelumnya') }}</button>
    <button class="flipbook-btn" id="nextBtn" onclick="nextSpread()">{{ __('Berikutnya') }} ⟶</button>

    <span class="flipbook-btn is-static">
      <span id="page-left-num">1</span> - <span id="page-right-num">2</span>
      / <span id="page-count">--</span>
    </span>

    <button class="flipbook-btn" onclick="zoomOut()">－</button>
    <button class="flipbook-btn" onclick="zoomIn()">＋</button>
    <button class="flipbook-btn" onclick="fitWidth()">{{ __('Sesuai Lebar') }}</button>

    <label class="sr-only" for="pageInput">{{ __('Nomor Halaman') }}</label>
    <input class="flipbook-page-input" id="pageInput" type="number" min="1" placeholder="{{ __('Halaman...') }}" />
    <button class="flipbook-btn" onclick="goToPage()">{{ __('Buka') }}</button>
  </div>
</div>

<!-- VIEWER -->
<div class="flipbook-viewer-wrapper">
  <div class="flipbook-book">
    <div class="flipbook-spread">
      <canvas class="flipbook-canvas left" id="pdf-left"></canvas>
      <canvas class="flipbook-canvas right" id="pdf-right"></canvas>
    </div>
  </div>
</div>

<!-- PDF.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>

<script>
const url = @json($pdfUrl);

pdfjsLib.GlobalWorkerOptions.workerSrc =
  "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js";

let pdfDoc = null;
let spreadIndex = 1;
let scale = 1.2;

const canvasLeft = document.getElementById("pdf-left");
const canvasRight = document.getElementById("pdf-right");
const ctxLeft = canvasLeft.getContext("2d");
const ctxRight = canvasRight.getContext("2d");

/* LOAD PDF */
pdfjsLib.getDocument(url).promise.then(function(pdf){
  pdfDoc = pdf;
  document.getElementById("page-count").innerText = pdfDoc.numPages;

  renderSpread();
  setTimeout(()=>fitWidth(), 150);
}).catch(function(error){
  alert(@json(__('PDF tidak bisa dimuat:')) + " " + error.message);
});

async function renderSinglePage(pageNum, canvas, ctx){
  if(pageNum < 1 || pageNum > pdfDoc.numPages){
    canvas.width = 10;
    canvas.height = 10;
    ctx.clearRect(0,0,canvas.width,canvas.height);
    return;
  }

  const page = await pdfDoc.getPage(pageNum);
  const viewport = page.getViewport({ scale: scale });
  const outputScale = window.devicePixelRatio || 1;

  canvas.style.width = viewport.width + "px";
  canvas.style.height = viewport.height + "px";

  canvas.width = Math.floor(viewport.width * outputScale);
  canvas.height = Math.floor(viewport.height * outputScale);

  ctx.setTransform(outputScale, 0, 0, outputScale, 0, 0);

  await page.render({
    canvasContext: ctx,
    viewport: viewport
  }).promise;
}

async function renderSpread(){
  if(!pdfDoc) return;

  const leftPage = spreadIndex;
  const rightPage = spreadIndex + 1;

  await renderSinglePage(leftPage, canvasLeft, ctxLeft);
  await renderSinglePage(rightPage, canvasRight, ctxRight);

  document.getElementById("page-left-num").innerText = leftPage;
  document.getElementById("page-right-num").innerText =
    (rightPage <= pdfDoc.numPages) ? rightPage : "-";

  document.getElementById("prevBtn").disabled = (spreadIndex <= 1);
  document.getElementById("nextBtn").disabled = (spreadIndex >= pdfDoc.numPages - 1);
}

function prevSpread(){
  if(!pdfDoc) return;
  if(spreadIndex <= 1) return;

  spreadIndex -= 2;
  if(spreadIndex < 1) spreadIndex = 1;

  renderSpread();
}

function nextSpread(){
  if(!pdfDoc) return;
  if(spreadIndex >= pdfDoc.numPages - 1) return;

  spreadIndex += 2;
  renderSpread();
}

function zoomIn(){
  scale += 0.15;
  renderSpread();
}

function zoomOut(){
  if(scale <= 0.6) return;
  scale -= 0.15;
  renderSpread();
}

function fitWidth(){
  if(!pdfDoc) return;

  const book = document.querySelector(".flipbook-book");
  const availableWidth = book.clientWidth - 40;
  const eachPageWidth = (availableWidth / 2) - 12;

  pdfDoc.getPage(spreadIndex).then(page=>{
    const baseViewport = page.getViewport({ scale: 1 });
    scale = eachPageWidth / baseViewport.width;
    renderSpread();
  });
}

function goToPage(){
  if(!pdfDoc) return;

  const input = document.getElementById("pageInput");
  let target = parseInt(input.value);

  if(isNaN(target)){
    alert(@json(__('Masukkan nomor halaman.')));
    return;
  }

  if(target < 1) target = 1;
  if(target > pdfDoc.numPages) target = pdfDoc.numPages;

  spreadIndex = (target % 2 === 0) ? target - 1 : target;
  if(spreadIndex < 1) spreadIndex = 1;

  renderSpread();
  input.value = "";
}

document.getElementById("pageInput").addEventListener("keydown", function(e){
  if(e.key === "Enter"){
    goToPage();
  }
});

document.addEventListener("keydown", (e)=>{
  if(e.key === "ArrowLeft") prevSpread();
  if(e.key === "ArrowRight") nextSpread();
});
</script>

</body>
</html>
