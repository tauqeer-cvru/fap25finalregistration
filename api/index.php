<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

  $url = "https://script.google.com/macros/s/AKfycbyfHLFPXAQfAwlw8cAtCQpELeqVMr_Pa5Mv2luzxsrqdW5yLcNRVdBnKex3mwX6Bz4/exec";
  $data = $_POST;

  $context = stream_context_create([
    "http"=>[
      "method"=>"POST",
      "header"=>"Content-Type: application/x-www-form-urlencoded",
      "content"=>http_build_query($data)
    ]
  ]);

  $result = file_get_contents($url,false,$context);

  echo "
  <div class='success-screen'>
    <div class='success-card'>
      <div class='check'>✓</div>
      <h2>Registration Successful</h2>
      <p>आपका Registration Number</p>
      <h3>$result</h3>
      <p class='small'>इस नंबर को सुरक्षित रखें</p>
    </div>
  </div>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="hi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fountain Academy – Final Registration</title>

<style>
body{
  margin:0;
  background:#f4f6fb;
  font-family:Segoe UI, sans-serif;
}
.container{
  max-width:420px;
  margin:auto;
  padding:16px;
}
.logo{
  text-align:center;
  margin:10px 0 20px;
}
.logo img{
  width:80px;
}
.card{
  background:#fff;
  border-radius:16px;
  padding:18px;
  box-shadow:0 10px 25px rgba(0,0,0,.12);
}
.progress{
  height:6px;
  background:#e0e0e0;
  border-radius:10px;
  overflow:hidden;
  margin-bottom:16px;
}
.progress-bar{
  height:100%;
  width:0%;
  background:linear-gradient(90deg,#3949ab,#1e88e5);
  transition:.4s;
}
.step{
  display:none;
}
.step.active{
  display:block;
}
h2{
  text-align:center;
  color:#1a237e;
  margin-bottom:12px;
}
label{
  font-size:14px;
  margin-top:12px;
  display:block;
}
input, textarea{
  width:96%;
  padding:2%;
  margin-top:6px;
  border-radius:10px;
  border:1px solid #ccc;
  font-size:15px;
}
textarea{min-height:80px}
.file-box{
  border:2px dashed #bbb;
  padding:14px;
  border-radius:10px;
  text-align:center;
  margin-top:6px;
}
.rating{
  display:flex;
  gap:6px;
  font-size:26px;
}
.rating span{
  cursor:pointer;
  color:#ccc;
}
.rating span.active{
  color:#ffca28;
}
button{
  width:100%;
  margin-top:18px;
  padding:14px;
  background:linear-gradient(135deg,#3949ab,#1e88e5);
  border:none;
  color:#fff;
  font-size:16px;
  border-radius:12px;
  cursor:pointer;
  box-shadow:0 6px 15px rgba(30,136,229,.4);
}
.next-btn{background:#1e88e5}
.success-screen{
  position:fixed;
  inset:0;
  background:#e8f5e9;
  display:flex;
  align-items:center;
  justify-content:center;
}
.success-card{
  background:#fff;
  padding:30px;
  border-radius:20px;
  text-align:center;
  box-shadow:0 12px 30px rgba(0,0,0,.2);
  animation:pop .5s ease;
}
.check{
  width:70px;
  height:70px;
  margin:auto;
  border-radius:50%;
  background:#4caf50;
  color:#fff;
  font-size:40px;
  line-height:70px;
}
.logo img {
    width: 400px;
}
.subject-box{
  border:1px solid #e0e0e0;
  padding:12px;
  border-radius:12px;
  margin-bottom:12px;
  background:#fafafa;
}

.undertaking{
  background:#fffde7;
  border-left:5px solid #fbc02d;
  padding:14px;
  border-radius:10px;
  font-size:14px;
  margin-top:16px;
}

.rating{
  display:flex;
  gap:6px;
  font-size:26px;
}
.rating span{
  cursor:pointer;
  color:#ccc;
}
.rating span.active{
  color:#ffca28;
}

@keyframes pop{
  from{transform:scale(.7);opacity:0}
  to{transform:scale(1);opacity:1}
}
.small{font-size:13px;color:#555}
</style>
</head>

<body>

<div class="container">
  <div class="logo">
    <img src="image/logo.jpeg" alt="Fountain Academy">
  </div>

  <div class="card">
    <div class="progress">
      <div class="progress-bar" id="bar"></div>
    </div>

    <form method="post">

      <!-- STEP 1 -->
      <div class="step active">
        <h2>छात्र विवरण</h2>
        <label>नाम</label><input name="name" required>
        <label>ईमेल</label><input type="email" name="email" required>
        <label>मोबाइल</label><input name="mobile" required>
        <label>रोल कोड</label><input name="rollcode" required>
        <label>रोल नंबर</label><input name="rollno" required>
        <button type="button" class="next-btn">Next</button>
      </div>

      <!-- STEP 2 -->
      <div class="step">
        <h2>दस्तावेज़</h2>
        <label>पासपोर्ट फोटो</label>
        <div class="file-box"><input type="file" id="photo" required></div>
        <label>Admit Card</label>
        <div class="file-box"><input type="file" id="admit" required></div>
        <input type="hidden" name="photo_base64" id="photo_base64">
        <input type="hidden" name="admit_base64" id="admit_base64">
        <button type="button" class="next-btn">Next</button>
      </div>

      <!-- STEP 3 -->
      <!-- STEP 3 -->
<div class="step">
  <h2>Subject Wise Feedback</h2>

  <div id="subjects">

    <div class="subject-box">
      <label>विषय का नाम *</label>
      <input class="sub-name" required placeholder="जैसे: Maths">

      <label>रेटिंग *</label>
      <div class="rating"></div>
    </div>

  </div>

  <button type="button" onclick="addSubject()" class="next-btn">
    + Add More Subject
  </button>

  <!-- hidden textarea for backend -->
  <textarea name="subject_feedback" id="subject_feedback" hidden required></textarea>

  <label>Teacher wise feedback *</label>
  <textarea name="teacher_feedback" required></textarea>

  <label>कोचिंग की कम से कम 3 कमियाँ *</label>
  <textarea name="kamiya" required></textarea>

  <label>सुधार कैसे किया जा सकता है? *</label>
  <textarea name="sudhar" required></textarea>

  <label>कोचिंग की 3 अच्छी बातें *</label>
  <textarea name="achhai" required></textarea>

  <label>खुलकर अपनी राय लिखें *</label>
  <textarea name="open" required></textarea>

  <div class="undertaking">
    <b>घोषणा पत्र</b><br><br>
    मैं यह घोषणा करता/करती हूँ कि मैंने कक्षा 12वीं/10वीं की सम्पूर्ण तैयारी
    <b>Fountain Academy</b> से ही की है।  
    मेरे द्वारा भरी गई समस्त जानकारी सत्य एवं सही है।  
    मुझे इस बात पर कोई आपत्ति नहीं है कि Fountain Academy
    मेरे नाम, फोटो एवं परीक्षा परिणाम को
    शैक्षणिक, प्रचारात्मक अथवा रिकॉर्ड उद्देश्य से प्रकाशित करे।  
    भविष्य में इस संबंध में किसी भी प्रकार की आपत्ति होने पर
    उसकी पूर्ण जिम्मेदारी मेरी स्वयं की होगी।
  </div>

  <label style="margin-top:12px">
    <input type="checkbox" required>
    मैं उपरोक्त घोषणा से पूर्णतः सहमत हूँ *
  </label>

  <button type="submit">Final Submit</button>
</div>


    </form>
  </div>
</div>

<script>
let step=0;
const steps=document.querySelectorAll(".step");
const bar=document.getElementById("bar");

document.querySelectorAll(".next-btn").forEach(btn=>{
 btn.onclick=()=>{
  if(!steps[step].querySelectorAll(":invalid").length){
    steps[step].classList.remove("active");
    step++;
    steps[step].classList.add("active");
    bar.style.width=(step+1)*33+"%";
  }else{
    alert("कृपया सभी अनिवार्य जानकारी भरें");
  }
 }
});

// ⭐ create rating
function initRating(box){
 let rating=box.querySelector(".rating");
 for(let i=1;i<=5;i++){
  let s=document.createElement("span");
  s.innerHTML="★";
  s.onclick=()=>{
    rating.querySelectorAll("span").forEach(x=>x.classList.remove("active"));
    for(let j=0;j<i;j++)rating.children[j].classList.add("active");
    rating.dataset.value=i;
  };
  rating.appendChild(s);
 }
 rating.dataset.value="";
}

// initial
document.querySelectorAll(".subject-box").forEach(initRating);

// add more subject
function addSubject(){
 let box=document.createElement("div");
 box.className="subject-box";
 box.innerHTML=`
   <label>विषय का नाम *</label>
   <input class="sub-name" required>

   <label>रेटिंग *</label>
   <div class="rating"></div>
 `;
 document.getElementById("subjects").appendChild(box);
 initRating(box);
}

// base64 + final submit
function toBase64(f,cb){
 let r=new FileReader();
 r.onload=()=>cb(r.result.split(',')[1]);
 r.readAsDataURL(f);
}

document.querySelector("form").onsubmit=function(e){

 // combine subject feedback
 let text="";
 let ok=true;

 document.querySelectorAll(".subject-box").forEach((b,i)=>{
   let name=b.querySelector(".sub-name").value;
   let rate=b.querySelector(".rating").dataset.value;
   if(!name || !rate) ok=false;
   text += (i+1)+". "+name+" : "+rate+"/5 ⭐\n";
 });

 if(!ok){
   alert("कृपया सभी विषय और उनकी रेटिंग भरें");
   return;
 }

 document.getElementById("subject_feedback").value=text;

 if(!this.checkValidity()){
   alert("कृपया सभी अनिवार्य फील्ड भरें");
   return;
 }

 e.preventDefault();
 toBase64(photo.files[0],p=>{
  photo_base64.value=p;
  toBase64(admit.files[0],a=>{
   admit_base64.value=a;
   e.target.submit();
  });
 });
};
</script>


</body>
</html>
