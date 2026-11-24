<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>fridaDineros · banco ficticio de ejemplo</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --navy:#1e3a5f; --navy-dark:#16294a; --gold:#d4a24a; --gold-dark:#8a5f12;
    --bg:#f4f6fa; --card:#ffffff; --text:#1b2a47; --muted:#5b6b86; --line:#e1e6ee;
    --green:#1f7a4d; --red:#b3261e; --cream:#fff4e0;
  }
  *{box-sizing:border-box;margin:0;padding:0}
  body{font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;flex-direction:column;line-height:1.45}
  a{color:inherit}
  button{font-family:inherit;cursor:pointer}

  /* Barra superior */
  header.nav{background:var(--navy);color:#fff;display:flex;align-items:center;gap:22px;padding:0 32px;height:70px;position:sticky;top:0;z-index:10}
  .logo{font-weight:800;font-size:24px;letter-spacing:.2px;text-decoration:none;color:#fff;white-space:nowrap}
  .logo span{color:var(--gold)}
  .nav-links{display:flex;gap:22px;align-items:center;height:100%;overflow-x:auto;scrollbar-width:none}
  .nav-links::-webkit-scrollbar{display:none}
  .nav-links a{color:#e8edf6;text-decoration:none;font-size:15px;height:100%;display:flex;align-items:center;border-bottom:3px solid transparent;white-space:nowrap}
  .nav-links a.active{color:#fff;font-weight:700;border-bottom-color:var(--gold)}
  .nav-right{margin-left:auto;display:flex;align-items:center;gap:16px;font-size:15px;white-space:nowrap}
  .nav-right a.salir{color:var(--gold);text-decoration:underline}

  /* Botones */
  .btn{border:none;border-radius:10px;padding:14px 22px;font-size:16px;font-weight:700;text-decoration:none;display:inline-block;text-align:center}
  .btn-gold{background:var(--gold);color:#1b2a47}
  .btn-navy{background:var(--navy);color:#fff}
  .btn-outline{background:#fff;color:var(--navy);border:2px solid var(--navy);padding:12px 20px}
  .btn-sm{padding:9px 14px;font-size:14px;border-radius:9px}
  .btn-danger{background:#fff;color:var(--red);border:2px solid var(--red)}
  .btn[disabled]{background:#e4e8ef;color:#7b879b;border-color:transparent;cursor:not-allowed}
  .btn-block{width:100%}

  main{flex:1;width:100%;max-width:1200px;margin:0 auto;padding:44px 32px 30px}
  .eyebrow{font-size:13px;font-weight:800;letter-spacing:.6px;text-transform:uppercase;color:var(--gold-dark);margin-bottom:6px}
  h1{font-size:46px;line-height:1.12;font-weight:800;color:var(--text)}
  h1.page{font-size:40px;margin-bottom:26px}
  h2{font-size:24px;font-weight:800}
  h3{font-size:19px;font-weight:700}
  .lead{font-size:18px;color:var(--muted);margin:16px 0 26px;max-width:560px}
  .card{background:var(--card);border-radius:20px;padding:26px;box-shadow:0 8px 30px rgba(30,58,95,.06)}
  .card.navy{background:var(--navy);color:#fff}
  .muted{color:var(--muted)}
  footer{text-align:right;color:var(--muted);font-size:13px;padding:20px 32px 28px}
  footer a{color:var(--muted)}

  /* Inicio */
  .hero{display:grid;grid-template-columns:1.1fr 1fr;gap:40px;align-items:center}
  .hero .btns{display:flex;gap:12px;flex-wrap:wrap}
  .bank-card{background:var(--navy);color:#fff;border-radius:26px;padding:28px 30px;aspect-ratio:1.7/1;display:flex;flex-direction:column;justify-content:space-between;box-shadow:0 18px 40px rgba(30,58,95,.28)}
  .bank-card .kind{color:#cfd8e8;font-size:16px}
  .bank-card .num{font-size:30px;letter-spacing:3px;font-weight:300}
  .bank-card .bottom{font-size:16px;display:flex;gap:18px}
  .products{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin:40px 0 20px}
  .product{background:#fff;border-radius:18px;padding:22px}
  .product p{color:var(--muted);margin-top:6px}
  .tip{background:var(--cream);border-radius:18px;padding:20px 24px}
  .tip p{color:#4a566e;margin-top:4px}

  /* Login */
  .split{display:grid;grid-template-columns:1fr 1fr;min-height:calc(100vh - 0px);flex:1}
  .split .left{background:var(--navy);color:#fff;padding:60px 64px;display:flex;flex-direction:column}
  .split .left .eyebrow{color:var(--gold)}
  .split .left h1{color:#fff;font-size:48px;margin-bottom:14px}
  .split .left p.lead{color:#d9e1ef}
  .split .left ul{list-style:none;display:grid;gap:12px;margin-top:6px}
  .split .left li{display:flex;gap:10px;align-items:center;color:#e6ecf6}
  .split .left .foot{margin-top:auto;font-size:13px;color:#cfd8e8;padding-top:40px}
  .split .right{display:flex;align-items:center;justify-content:center;padding:40px 24px}
  .split .right .card{width:100%;max-width:480px}
  body.login-page header.nav{display:none}
  body.login-page footer{display:none}
  body.login-page main{max-width:none;padding:0;display:flex}
  body.login-page .split{width:100%}

  /* Formularios */
  label{display:block;font-weight:700;margin:16px 0 7px;font-size:15px}
  input[type=text],input[type=password],input[type=tel],input[type=number],select{width:100%;border:1.5px solid #b9c4d6;border-radius:11px;padding:14px 15px;font-size:16px;font-family:inherit;background:#fff;color:var(--text)}
  input:focus,select:focus{outline:3px solid rgba(212,162,74,.45);border-color:var(--gold)}
  input[readonly]{background:#f1f4f9}
  .hint{font-size:13.5px;color:var(--muted);margin-top:7px}
  .links-row{text-align:center;margin-top:18px;font-size:15px;color:var(--muted)}
  .links-row a{color:var(--muted)}
  .seg{display:grid;grid-template-columns:1fr 1fr;gap:12px}
  .seg button{border:1.5px solid #b9c4d6;background:#fff;color:var(--text);border-radius:11px;padding:13px;font-weight:700;font-size:16px}
  .seg button.on{background:var(--navy);color:#fff;border-color:var(--navy)}
  .row2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
  .msg{border-radius:12px;padding:12px 14px;margin-top:16px;font-size:14.5px;display:none}
  .msg.err{display:block;background:#fdeceb;color:#8c1d18}
  .msg.ok{display:block;background:#e6f4ec;color:#17613d}
  .demo{font-size:13px;color:var(--gold-dark);text-align:center;margin-top:14px;background:var(--cream);padding:9px 12px;border-radius:10px}

  .two{display:grid;grid-template-columns:1.35fr 1fr;gap:28px;align-items:start}
  .reg-grid{display:grid;grid-template-columns:1.1fr 1fr;gap:40px;align-items:start}

  /* Resumen */
  .stats{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
  .stat .label{color:var(--muted);font-size:16px}
  .stat .big{font-size:44px;font-weight:800;margin:6px 0;letter-spacing:-.5px}
  .stat.navy .label{color:#cfd8e8}
  .stat .small{font-size:14px;color:var(--muted)}
  .stat.navy .small{color:#d9e1ef}
  .green{color:var(--green)}
  .actions{display:flex;gap:14px;flex-wrap:wrap;margin:22px 0}
  table{width:100%;border-collapse:collapse}
  th{text-align:left;color:var(--muted);font-weight:700;font-size:15px;padding:12px 4px;border-bottom:2px solid var(--line)}
  td{padding:15px 4px;border-bottom:1px solid var(--line);font-size:16px}
  tr:last-child td{border-bottom:none}
  .r{text-align:right}
  .pos{color:var(--green)}
  .table-wrap{overflow-x:auto}

  /* Transferencias */
  .freq{background:#fff;border-radius:14px;padding:14px 18px;margin-bottom:14px;cursor:pointer;border:2px solid transparent;width:100%;text-align:left}
  .freq:hover{border-color:var(--gold)}
  .freq b{display:block;font-size:17px}
  .freq span{color:var(--muted);font-size:15px}

  /* Tarjetas */
  .cards-grid{display:grid;grid-template-columns:1fr 1.1fr;gap:26px;align-items:start}
  .opt{display:flex;justify-content:space-between;align-items:center;padding:15px 0;border-top:1px solid var(--line);font-size:16px;gap:12px}
  .opt button{background:none;border:none;font-weight:800;font-size:16px;font-family:inherit}
  .st-on{color:var(--green)} .st-off{color:var(--muted)} .st-act{color:var(--gold-dark)}
  .bank-card.blocked{filter:grayscale(1);opacity:.75}

  /* Admin */
  .actions-cell{display:flex;gap:8px;justify-content:flex-end}
  .back{display:inline-block;margin-bottom:12px;font-weight:700;color:var(--navy)}
  .info-grid{display:grid;grid-template-columns:1fr 1.3fr 1fr;gap:20px;margin-bottom:22px}
  .info .label{color:var(--muted);font-size:15px}
  .info .val{font-size:26px;font-weight:800;margin-top:4px;word-break:break-all}
  .info.navy .label{color:#cfd8e8}
  .delete-row{display:flex;align-items:center;gap:16px;margin-top:22px;flex-wrap:wrap}

  /* Aviso emergente */
  #toast{position:fixed;left:50%;bottom:26px;transform:translateX(-50%) translateY(30px);background:var(--navy-dark);color:#fff;padding:14px 20px;border-radius:14px;box-shadow:0 12px 30px rgba(0,0,0,.25);opacity:0;pointer-events:none;transition:.3s;max-width:92vw;z-index:50;font-size:15px;text-align:center}
  #toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
  #toast b{color:var(--gold)}

  /* Celular */
  @media (max-width:900px){
    header.nav{padding:0 16px;gap:14px;height:64px}
    .logo{font-size:20px}
    .nav-right .hola{display:none}
    main{padding:28px 18px 20px}
    h1{font-size:34px} h1.page{font-size:32px}
    .hero,.two,.reg-grid,.cards-grid{grid-template-columns:1fr}
    .products{grid-template-columns:1fr 1fr}
    .stats,.info-grid{grid-template-columns:1fr}
    .split{grid-template-columns:1fr}
    .split .left{padding:36px 24px}
    .split .left .foot{display:none}
    .split .left h1{font-size:34px}
    .bank-card .num{font-size:22px;letter-spacing:2px}
    .row2{grid-template-columns:1fr}
    footer{text-align:center;padding:16px}
  }
  @media (max-width:520px){
    .products{grid-template-columns:1fr}
    .stat .big{font-size:36px}
  }
</style>
</head>
<body>
<div id="top"></div>
<div id="app"></div>
<div id="toast"></div>

<script>
/* ============================================================
   fridaBineros · banco ficticio de ejemplo
   Todo funciona en tu navegador (datos de demostración).
   ============================================================ */
const KEY = 'fridaDinerosDB_v1';
const MESES = ['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'];

const SEED = () => ({
  session: null,
  users: [
    { user:'frida_olvera', pass:'frida1234', phone:'4491234567', role:'cliente', account:'0123 4567 8901 234567',
      balance:12450, credit:1820, invest:5000, blocked:false, online:true, abroad:false, alerts:true,
      movs:[
        {f:'2026-11-15',tipo:'Depósito',concepto:'Depósito de nómina',dest:'Mi cuenta',monto:3200},
        {f:'2026-11-14',tipo:'Transferencia',concepto:'Pago de servicio de internet',dest:'Proveedor de internet',monto:-389},
        {f:'2026-11-12',tipo:'Transferencia',concepto:'Compra en línea',dest:'Tienda en línea',monto:-650},
        {f:'2026-11-10',tipo:'Transferencia',concepto:'Apoyo',dest:'Mamá',monto:-500},
        {f:'2026-11-05',tipo:'Depósito',concepto:'Depósito',dest:'Mi cuenta',monto:1000}
      ]},
    { user:'carlos_m', pass:'demo1234', phone:'4491112233', role:'cliente', account:'0123 4567 8901 998811',
      balance:3820.50, credit:0, invest:0, blocked:false, online:true, abroad:false, alerts:true,
      movs:[{f:'2026-11-11',tipo:'Depósito',concepto:'Depósito',dest:'Mi cuenta',monto:3820.50}]},
    { user:'ana_lopez', pass:'demo1234', phone:'4494445566', role:'cliente', account:'0123 4567 8901 551203',
      balance:0, credit:0, invest:0, blocked:false, online:true, abroad:false, alerts:true, movs:[]},
    { user:'luis_r', pass:'demo1234', phone:'4497778899', role:'cliente', account:'0123 4567 8901 307745',
      balance:760, credit:0, invest:0, blocked:false, online:true, abroad:false, alerts:true,
      movs:[{f:'2026-11-09',tipo:'Depósito',concepto:'Depósito',dest:'Mi cuenta',monto:760}]},
    { user:'admin', pass:'admin1234', phone:'4490000000', role:'admin', account:'', balance:0, movs:[] }
  ]
});

let db;
function load(){
  try{ const s = localStorage.getItem(KEY); db = s ? JSON.parse(s) : SEED(); }catch(e){ db = SEED(); }
}
function save(){ try{ localStorage.setItem(KEY, JSON.stringify(db)); }catch(e){} }
load();

const FRECUENTES = [
  {name:'Mamá', tail:'4421'},
  {name:'Renta', tail:'7710'},
  {name:'Escuela', tail:'3302'}
];

/* ---------- utilidades ---------- */
const $ = (s, r=document) => r.querySelector(s);
const $$ = (s, r=document) => [...r.querySelectorAll(s)];
const esc = s => String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
const fmt = n => '$' + Number(n).toLocaleString('en-US',{minimumFractionDigits:2,maximumFractionDigits:2});
const fmtMov = n => (n>=0?'+ ':'- ') + fmt(Math.abs(n));
const fecha = iso => { const [y,m,d] = iso.split('-'); return d + ' ' + MESES[+m-1]; };
const hoy = () => { const d = new Date(); return d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0'); };
const me = () => db.users.find(u => u.user === db.session) || null;
const cap = s => s.charAt(0).toUpperCase() + s.slice(1);
const primerNombre = u => cap(u.user.split('_')[0]);
const nombreTarjeta = u => u.user.split('_').join(' ').toUpperCase();
const norm = s => s.toLowerCase().replace(/\s+/g,'');

let toastTimer;
function toast(html, ms=5000){
  const t = $('#toast'); t.innerHTML = html; t.classList.add('show');
  clearTimeout(toastTimer); toastTimer = setTimeout(()=>t.classList.remove('show'), ms);
}

let smsCode = '';
function nuevoCodigo(){
  smsCode = String(Math.floor(100000 + Math.random()*900000));
  toast('📱 SMS (simulado): tu código de verificación es <b>'+smsCode+'</b>', 9000);
}
function showMsg(el, text, type='err'){ el.className = 'msg ' + type; el.textContent = text; }

/* ---------- componentes ---------- */
const FOOT = `<footer>fridaBineros · banco ficticio de ejemplo · <a href="#" id="reset">Reiniciar datos de demostración</a></footer>`;

function navPublic(){
  return `<header class="nav">
    <a class="logo" href="#/inicio">frida<span>Bineros</span></a>
    <nav class="nav-links">
      <a href="#/inicio" data-go="productos">Cuentas</a>
      <a href="#/inicio" data-go="productos">Tarjetas</a>
      <a href="#/inicio" data-go="productos">Créditos</a>
      <a href="#/inicio" data-go="productos">Inversiones</a>
      <a href="#/inicio" data-go="seguridad">Ayuda</a>
    </nav>
    <div class="nav-right"><a class="btn btn-gold btn-sm" href="#/login">Iniciar sesión</a></div>
  </header>`;
}
function navClient(active, u){
  const items = [['resumen','Resumen'],['transferir','Transferir'],['depositar','Depositar'],['movimientos','Movimientos'],['tarjetas','Tarjetas']];
  return `<header class="nav">
    <a class="logo" href="#/resumen">frida<span>Bineros</span></a>
    <nav class="nav-links">${items.map(([k,t])=>`<a href="#/${k}" class="${k===active?'active':''}">${t}</a>`).join('')}</nav>
    <div class="nav-right"><span class="hola">Hola, ${esc(primerNombre(u))}</span><a class="salir" href="#/salir">Salir</a></div>
  </header>`;
}
function navAdmin(){
  return `<header class="nav">
    <a class="logo" href="#/admin">frida<span>Bineros</span></a>
    <nav class="nav-links"><a href="#/admin" class="active">Clientes</a></nav>
    <div class="nav-right"><span class="hola">Administrador</span><a class="salir" href="#/salir">Salir</a></div>
  </header>`;
}

/* ---------- PÁGINAS ---------- */
const views = {};

/* 1 · Inicio */
views.inicio = () => ({
  nav: navPublic(),
  html: `
  <div class="hero">
    <div>
      <div class="eyebrow">Página 1 · Inicio</div>
      <h1>Tu dinero seguro, a un clic de distancia</h1>
      <p class="lead">Abre tu cuenta 100% en línea, sin comisiones por manejo y con atención las 24 horas.</p>
      <div class="btns">
        <a class="btn btn-gold" href="#/registro">Abrir mi cuenta</a>
        <a class="btn btn-navy" href="#/inicio" data-go="productos">Conocer más</a>
      </div>
    </div>
    <div class="bank-card">
      <div class="kind">Tarjeta de débito</div>
      <div class="num">•••• •••• •••• 4821</div>
      <div class="bottom"><span>FRIDA OLVERA</span><span>11/29</span></div>
    </div>
  </div>
  <div class="products" id="productos">
    <div class="product"><h3>Cuenta digital</h3><p>Ahorra y paga desde tu celular.</p></div>
    <div class="product"><h3>Tarjeta de crédito</h3><p>Compra hoy y paga después.</p></div>
    <div class="product"><h3>Inversión a plazo</h3><p>Haz crecer tu dinero.</p></div>
    <div class="product"><h3>Crédito personal</h3><p>Dinero rápido, pagos fijos.</p></div>
  </div>
  <div class="tip" id="seguridad"><h3>Consejos de seguridad</h3><p>fridaBineros nunca te pedirá tu NIP por llamada o mensaje.</p></div>`
});

/* 2 · Iniciar sesión */
let modoAdmin = false;
views.login = () => ({
  nav: '', bodyClass: 'login-page',
  html: `
  <div class="split">
    <div class="left">
      <a class="logo" href="#/inicio" style="font-size:28px">frida<span>Bineros</span></a>
      <div style="margin-top:90px">
        <div class="eyebrow">Página 2 · Iniciar sesión</div>
        <h1>${modoAdmin ? 'Acceso administrador' : 'Bienvenida de vuelta'}</h1>
        <p class="lead">Consulta tus saldos, haz transferencias y paga tus servicios con total seguridad.</p>
        <ul>
          <li>🔒 Cifrado de extremo a extremo</li>
          <li>🔒 Verificación en dos pasos</li>
        </ul>
      </div>
      <div class="foot">fridaBineros · banco ficticio de ejemplo</div>
    </div>
    <div class="right">
      <form class="card" id="f-login" autocomplete="off">
        <h2>${modoAdmin ? 'Entra como administrador' : 'Entra a tu cuenta'}</h2>
        <label for="l-user">Usuario o número de cliente</label>
        <input type="text" id="l-user" placeholder="Ej. cliente123" autocapitalize="none">
        <label for="l-pass">Contraseña</label>
        <input type="password" id="l-pass" placeholder="••••••••">
        <div class="msg" id="l-msg"></div>
        <button class="btn btn-navy btn-block" style="margin-top:22px" type="submit">Entrar</button>
        <div class="links-row">
          <a href="#" id="olvide">¿Olvidaste tu contraseña?</a> · <a href="#/registro">Crear cuenta</a><br>
          <a href="#" id="toggle-admin" style="font-size:14px;display:inline-block;margin-top:8px">${modoAdmin ? 'Acceso de cliente' : 'Acceso administrador'}</a>
        </div>
        <p class="hint" style="text-align:center;color:var(--gold-dark);margin-top:14px">fridaBineros nunca te pedirá tu NIP por llamada o mensaje.</p>
        <div class="demo">Demo: <b>frida_olvera</b> / <b>frida1234</b> · Admin: <b>admin</b> / <b>admin1234</b></div>
      </form>
    </div>
  </div>`,
  bind(){
    $('#f-login').addEventListener('submit', e=>{
      e.preventDefault();
      const user = $('#l-user').value.trim(), pass = $('#l-pass').value;
      const u = db.users.find(x => x.user.toLowerCase()===user.toLowerCase() || (x.account && norm(x.account)===norm(user)));
      const msg = $('#l-msg');
      if(!user || !pass) return showMsg(msg,'Escribe tu usuario y tu contraseña.');
      if(!u || u.pass!==pass) return showMsg(msg,'Usuario o contraseña incorrectos.');
      if(modoAdmin && u.role!=='admin') return showMsg(msg,'Esta cuenta no es de administrador.');
      if(!modoAdmin && u.role==='admin') return showMsg(msg,'Esta es una cuenta de administrador. Usa "Acceso administrador".');
      db.session = u.user; save();
      location.hash = u.role==='admin' ? '#/admin' : '#/resumen';
    });
    $('#olvide').addEventListener('click', e=>{ e.preventDefault(); toast('En esta demo no se puede recuperar la contraseña 🙂'); });
    $('#toggle-admin').addEventListener('click', e=>{ e.preventDefault(); modoAdmin = !modoAdmin; render(); });
  }
});

/* 3 · Registro */
let tipoReg = 'cliente';
views.registro = () => ({
  nav: navPublic(),
  html: `
  <div class="reg-grid">
    <div>
      <div class="eyebrow">Página 3 · Registro</div>
      <h1>Crea tu cuenta <span style="font-size:.8em">fridaBineros</span></h1>
      <p class="lead">Solo necesitas un usuario, una contraseña y tu número de teléfono. Cada cliente tiene una sola cuenta.</p>
      <p class="muted">Te enviaremos por SMS un código de verificación cada vez que deposites o transfieras dinero.</p>
    </div>
    <form class="card" id="f-reg" autocomplete="off">
      <h2>Regístrate</h2>
      <label>Tipo de usuario</label>
      <div class="seg">
        <button type="button" data-t="cliente" class="${tipoReg==='cliente'?'on':''}">Cliente</button>
        <button type="button" data-t="admin" class="${tipoReg==='admin'?'on':''}">Administrador</button>
      </div>
      <label for="r-user">Usuario</label>
      <input type="text" id="r-user" placeholder="Ej. frida_olvera" autocapitalize="none">
      <label for="r-pass">Contraseña</label>
      <input type="password" id="r-pass" placeholder="Mínimo 6 caracteres">
      <label for="r-tel">Número telefónico</label>
      <input type="tel" id="r-tel" placeholder="Ej. 449 123 4567" inputmode="numeric">
      <div class="msg" id="r-msg"></div>
      <button class="btn btn-navy btn-block" style="margin-top:22px" type="submit">Registrarme</button>
      <div class="links-row">¿Ya tienes cuenta? <a href="#/login">Inicia sesión</a></div>
    </form>
  </div>`,
  bind(){
    $$('.seg button').forEach(b => b.addEventListener('click', ()=>{
      tipoReg = b.dataset.t; $$('.seg button').forEach(x=>x.classList.toggle('on', x===b));
    }));
    $('#f-reg').addEventListener('submit', e=>{
      e.preventDefault();
      const user = $('#r-user').value.trim(), pass = $('#r-pass').value, tel = $('#r-tel').value.replace(/\D/g,'');
      const msg = $('#r-msg');
      if(!/^[A-Za-z0-9_.-]{3,20}$/.test(user)) return showMsg(msg,'El usuario debe tener de 3 a 20 letras, números o guion bajo.');
      if(pass.length<6) return showMsg(msg,'La contraseña debe tener al menos 6 caracteres.');
      if(tel.length!==10) return showMsg(msg,'Escribe tu teléfono a 10 dígitos.');
      if(db.users.some(x=>x.user.toLowerCase()===user.toLowerCase())) return showMsg(msg,'Ese usuario ya existe. Elige otro.');
      let acc;
      do { acc = '0123 4567 8901 ' + String(Math.floor(100000+Math.random()*900000)); } while(db.users.some(x=>x.account===acc));
      const nuevo = tipoReg==='admin'
        ? {user, pass, phone:tel, role:'admin', account:'', balance:0, movs:[]}
        : {user, pass, phone:tel, role:'cliente', account:acc, balance:0, credit:0, invest:0, blocked:false, online:true, abroad:false, alerts:true, movs:[]};
      db.users.push(nuevo); db.session = user; save();
      toast('¡Cuenta creada! Bienvenida a fridaBineros 🎉');
      location.hash = tipoReg==='admin' ? '#/admin' : '#/resumen';
    });
  }
});

/* 4 · Mi cuenta */
views.resumen = (u) => ({
  nav: navClient('resumen', u),
  html: `
  <div class="eyebrow">Página 4 · Mi cuenta</div>
  <h1 class="page">Resumen de tus cuentas</h1>
  <div class="stats">
    <div class="card navy stat">
      <div class="label">Cuenta de ahorro</div>
      <div class="big">${fmt(u.balance)}</div>
      <div>Disponible</div>
      <div class="small" style="margin-top:10px">N.º de cuenta: ${esc(u.account)}</div>
    </div>
    <div class="card stat">
      <div class="label">Tarjeta de crédito</div>
      <div class="big">${fmt(u.credit)}</div>
      <div class="small">${u.credit>0?'Pago al: 25 nov':'Sin adeudo'}</div>
    </div>
    <div class="card stat">
      <div class="label">Inversión a plazo</div>
      <div class="big green">${fmt(u.invest)}</div>
      <div class="small">Rendimiento anual: 8%</div>
    </div>
  </div>
  <div class="actions">
    <a class="btn btn-gold" href="#/transferir">Realizar transferencia</a>
    <a class="btn btn-navy" href="#/depositar">Depositar dinero</a>
    <a class="btn btn-outline" href="#/movimientos">Consultar movimientos</a>
  </div>
  <div class="card">
    <h2 style="font-size:22px;margin-bottom:8px">Últimos movimientos</h2>
    <div class="table-wrap"><table>
      <thead><tr><th style="width:110px">Fecha</th><th>Concepto</th><th class="r">Monto</th></tr></thead>
      <tbody>${u.movs.length ? u.movs.slice(0,3).map(m=>`<tr><td>${fecha(m.f)}</td><td>${esc(m.concepto)}</td><td class="r ${m.monto>=0?'pos':''}">${fmtMov(m.monto)}</td></tr>`).join('')
        : `<tr><td colspan="3" class="muted">Todavía no tienes movimientos.</td></tr>`}</tbody>
    </table></div>
  </div>`
});

/* 5 · Transferencias */
views.transferir = (u) => ({
  nav: navClient('transferir', u),
  html: `
  <div class="eyebrow">Página 5 · Transferencias</div>
  <h1 class="page">Enviar dinero</h1>
  <div class="two">
    <form class="card" id="f-tr" autocomplete="off">
      <label style="margin-top:0">Cuenta de origen</label>
      <input type="text" readonly value="Cuenta de ahorro · ${fmt(u.balance)}" id="t-origen">
      <label for="t-dest">Cuenta o cliente a buscar</label>
      <input type="text" id="t-dest" placeholder="0123 4567 8901 234567 o nombre de usuario" autocapitalize="none">
      <div class="row2">
        <div><label for="t-monto">Cantidad a transferir</label><input type="number" id="t-monto" placeholder="$ 500.00" min="0" step="0.01" inputmode="decimal"></div>
        <div><label for="t-conc">Concepto</label><input type="text" id="t-conc" placeholder="Pago de renta" maxlength="40"></div>
      </div>
      <label for="t-code">Código de verificación (SMS)</label>
      <input type="text" id="t-code" placeholder="Código de 6 dígitos" inputmode="numeric" maxlength="6">
      <p class="hint">Te enviamos un código al número que registraste. <a href="#" id="t-reenviar">Reenviar código</a></p>
      <div class="msg" id="t-msg"></div>
      <button class="btn btn-navy" style="margin-top:20px" type="submit">Transferir ahora</button>
    </form>
    <div>
      <h2 style="margin-bottom:16px">Frecuentes</h2>
      ${FRECUENTES.map(f=>`<button type="button" class="freq" data-n="${f.name}"><b>${f.name}</b><span>Banco aliado · ••• ${f.tail}</span></button>`).join('')}
      <p class="muted" style="margin-top:6px">Las transferencias entre bancos se realizan por SPEI, en segundos.</p>
    </div>
  </div>`,
  bind(u){
    nuevoCodigo();
    $$('.freq').forEach(b=>b.addEventListener('click',()=>{ $('#t-dest').value = b.dataset.n; $('#t-monto').focus(); }));
    $('#t-reenviar').addEventListener('click', e=>{ e.preventDefault(); nuevoCodigo(); });
    $('#f-tr').addEventListener('submit', e=>{
      e.preventDefault();
      const msg = $('#t-msg');
      const q = $('#t-dest').value.trim();
      const monto = Math.round(parseFloat($('#t-monto').value)*100)/100;
      const conc = $('#t-conc').value.trim() || 'Transferencia';
      const code = $('#t-code').value.trim();
      if(!q) return showMsg(msg,'Escribe la cuenta o el usuario al que quieres enviar.');
      if(!(monto>0)) return showMsg(msg,'Escribe una cantidad mayor a $0.00.');
      if(monto>u.balance) return showMsg(msg,'No tienes saldo suficiente para esta transferencia.');
      if(u.blocked) return showMsg(msg,'Tu tarjeta está bloqueada temporalmente. Desbloquéala en "Tarjetas".');
      // buscar destino: cliente interno o frecuente
      let destino = db.users.find(x => x.role==='cliente' && (x.user.toLowerCase()===q.toLowerCase() || norm(x.account)===norm(q)));
      let destNombre, externo = null;
      if(destino){
        if(destino.user===u.user) return showMsg(msg,'No puedes transferirte a tu propia cuenta.');
        destNombre = destino.user;
      } else {
        externo = FRECUENTES.find(f=>f.name.toLowerCase()===q.toLowerCase());
        if(!externo) return showMsg(msg,'No encontramos esa cuenta o cliente. Revisa el dato o elige un frecuente.');
        destNombre = externo.name;
      }
      if(code!==smsCode) return showMsg(msg,'El código de verificación no es correcto.');
      const f = hoy();
      u.balance = Math.round((u.balance-monto)*100)/100;
      u.movs.unshift({f,tipo:'Transferencia',concepto:conc,dest:destNombre,monto:-monto});
      if(destino){
        destino.balance = Math.round((destino.balance+monto)*100)/100;
        destino.movs.unshift({f,tipo:'Transferencia',concepto:conc,dest:u.user,monto:monto});
      }
      save();
      toast('✅ Transferiste <b>'+fmt(monto)+'</b> a '+esc(destNombre));
      location.hash = '#/movimientos';
    });
  }
});

/* 6 · Depósitos */
views.depositar = (u) => ({
  nav: navClient('depositar', u),
  html: `
  <div class="eyebrow">Página 6 · Depósitos</div>
  <h1 class="page">Depositar dinero</h1>
  <div class="two">
    <form class="card" id="f-dep" autocomplete="off">
      <label style="margin-top:0">Cuenta destino</label>
      <input type="text" readonly value="Cuenta de ahorro · ${esc(u.account)}">
      <label for="d-monto">Cantidad a ingresar</label>
      <input type="number" id="d-monto" placeholder="$ 1,000.00" min="0" step="0.01" inputmode="decimal">
      <label for="d-code">Código de validación (SMS)</label>
      <input type="text" id="d-code" placeholder="Código de 6 dígitos" inputmode="numeric" maxlength="6">
      <p class="hint">Te enviamos un código al número que registraste. <a href="#" id="d-reenviar">Reenviar código</a></p>
      <div class="msg" id="d-msg"></div>
      <button class="btn btn-navy" style="margin-top:20px" type="submit">Depositar ahora</button>
    </form>
    <div>
      <div class="card navy stat"><div class="label">Saldo actual</div><div class="big" id="d-saldo">${fmt(u.balance)}</div><div>Cuenta de ahorro</div></div>
      <p class="muted" style="margin-top:16px">El dinero se refleja en tu cuenta al instante, después de validar el código.</p>
    </div>
  </div>`,
  bind(u){
    nuevoCodigo();
    $('#d-reenviar').addEventListener('click', e=>{ e.preventDefault(); nuevoCodigo(); });
    $('#f-dep').addEventListener('submit', e=>{
      e.preventDefault();
      const msg = $('#d-msg');
      const monto = Math.round(parseFloat($('#d-monto').value)*100)/100;
      if(!(monto>0)) return showMsg(msg,'Escribe una cantidad mayor a $0.00.');
      if($('#d-code').value.trim()!==smsCode) return showMsg(msg,'El código de validación no es correcto.');
      u.balance = Math.round((u.balance+monto)*100)/100;
      u.movs.unshift({f:hoy(),tipo:'Depósito',concepto:'Depósito',dest:'Mi cuenta',monto:monto});
      save();
      toast('✅ Depositaste <b>'+fmt(monto)+'</b> en tu cuenta');
      location.hash = '#/movimientos';
    });
  }
});

/* 7 · Movimientos */
views.movimientos = (u) => ({
  nav: navClient('movimientos', u),
  html: `
  <div class="eyebrow">Página 7 · Movimientos</div>
  <h1 class="page">Tus movimientos</h1>
  <div class="card"><div class="table-wrap"><table>
    <thead><tr><th style="width:100px">Fecha</th><th style="width:170px">Tipo</th><th>Destinatario</th><th class="r">Cantidad</th></tr></thead>
    <tbody>${u.movs.length ? u.movs.map(m=>`<tr><td>${fecha(m.f)}</td><td>${esc(m.tipo)}</td><td>${esc(m.dest)}</td><td class="r ${m.monto>=0?'pos':''}">${fmtMov(m.monto)}</td></tr>`).join('')
      : `<tr><td colspan="4" class="muted">Todavía no tienes movimientos.</td></tr>`}</tbody>
  </table></div></div>
  <p class="muted" style="margin-top:14px">Las transferencias y los depósitos se consideran movimientos.</p>`
});

/* 8 · Tarjetas y seguridad */
views.tarjetas = (u) => {
  const opt = (k, label, onTxt, offTxt, inverse) => {
    const on = u[k];
    const cls = inverse ? (on?'st-act':'st-act') : (on?'st-on':'st-off');
    return `<div class="opt"><span>${label}</span><button data-k="${k}" class="${cls}">${on?onTxt:offTxt}</button></div>`;
  };
  return {
    nav: navClient('tarjetas', u),
    html: `
    <div class="eyebrow">Página 8 · Tarjetas y seguridad</div>
    <h1 class="page">Controla tus tarjetas</h1>
    <div class="cards-grid">
      <div class="bank-card ${u.blocked?'blocked':''}">
        <div class="kind">Débito${u.blocked?' · Bloqueada':''}</div>
        <div class="num">•••• •••• •••• 4821</div>
        <div class="bottom"><span>${esc(nombreTarjeta(u))}</span><span>11/29</span></div>
      </div>
      <div class="card">
        <h2 style="margin-bottom:12px">Opciones</h2>
        <div class="opt"><span>Bloquear tarjeta temporalmente</span><button data-k="blocked" class="st-act">${u.blocked?'Desbloquear':'Activar'}</button></div>
        ${opt('online','Compras en línea','Activado','Desactivado')}
        ${opt('abroad','Compras en el extranjero','Activado','Desactivado')}
        ${opt('alerts','Alertas por cada movimiento','Activado','Desactivado')}
      </div>
    </div>
    <div class="tip" style="margin-top:26px"><h3>Consejos de seguridad</h3><p>No compartas tu NIP ni códigos de verificación, usa solo la app oficial y reporta cualquier cargo que no reconozcas al instante.</p></div>`,
    bind(u){
      $$('.opt button').forEach(b=>b.addEventListener('click',()=>{
        const k = b.dataset.k; u[k] = !u[k]; save(); render();
        if(k==='blocked') toast(u.blocked ? '🔒 Tarjeta bloqueada temporalmente' : '🔓 Tarjeta desbloqueada');
      }));
    }
  };
};

/* 9 · Admin: clientes */
views.admin = () => {
  const clientes = db.users.filter(x=>x.role==='cliente');
  return {
    nav: navAdmin(),
    html: `
    <div class="eyebrow">Página 9 · Administrador</div>
    <h1 class="page">Clientes de la plataforma</h1>
    <div class="card"><div class="table-wrap"><table>
      <thead><tr><th>Usuario</th><th>Número de cuenta</th><th class="r">Saldo</th><th class="r">Acciones</th></tr></thead>
      <tbody>${clientes.map(c=>`<tr>
        <td>${esc(c.user)}</td><td>${esc(c.account)}</td><td class="r">${fmt(c.balance)}</td>
        <td><div class="actions-cell">
          <a class="btn btn-outline btn-sm" href="#/admin/${encodeURIComponent(c.user)}">Ver detalle</a>
          <button class="btn btn-sm ${c.balance===0?'btn-danger':''}" data-del="${esc(c.user)}" ${c.balance===0?'':'disabled'}>Eliminar</button>
        </div></td></tr>`).join('') || `<tr><td colspan="4" class="muted">No hay clientes.</td></tr>`}</tbody>
    </table></div></div>
    <p class="muted" style="margin-top:14px">Solo se puede eliminar a un cliente cuando su cuenta está en $0.00.</p>`,
    bind(){
      $$('[data-del]').forEach(b=>b.addEventListener('click',()=>{
        const name = b.dataset.del;
        if(confirm('¿Eliminar al cliente "'+name+'"? Esta acción no se puede deshacer.')){
          db.users = db.users.filter(x=>x.user!==name); save(); render(); toast('Cliente eliminado');
        }
      }));
    }
  };
};

/* 10 · Admin: detalle */
views.detalle = (_u, arg) => {
  const c = db.users.find(x=>x.user===decodeURIComponent(arg||'') && x.role==='cliente');
  if(!c) return { redirect:'#/admin' };
  return {
    nav: navAdmin(),
    html: `
    <a class="back" href="#/admin">← Volver a clientes</a>
    <div class="eyebrow">Página 10 · Detalle de cliente</div>
    <h1 class="page">Detalle del cliente</h1>
    <div class="info-grid">
      <div class="card info"><div class="label">Usuario</div><div class="val">${esc(c.user)}</div></div>
      <div class="card info"><div class="label">Número de cuenta</div><div class="val">${esc(c.account)}</div></div>
      <div class="card info navy"><div class="label">Saldo</div><div class="val">${fmt(c.balance)}</div></div>
    </div>
    <div class="card">
      <h2 style="font-size:22px;margin-bottom:8px">Movimientos del cliente</h2>
      <div class="table-wrap"><table>
        <thead><tr><th style="width:100px">Fecha</th><th style="width:170px">Tipo</th><th>Destinatario</th><th class="r">Cantidad</th></tr></thead>
        <tbody>${c.movs.length ? c.movs.map(m=>`<tr><td>${fecha(m.f)}</td><td>${esc(m.tipo)}</td><td>${esc(m.dest)}</td><td class="r ${m.monto>=0?'pos':''}">${fmtMov(m.monto)}</td></tr>`).join('')
          : `<tr><td colspan="4" class="muted">Sin movimientos.</td></tr>`}</tbody>
      </table></div>
    </div>
    <div class="delete-row">
      <button class="btn ${c.balance===0?'btn-danger':''}" id="del-cli" ${c.balance===0?'':'disabled'}>Eliminar cliente</button>
      <span class="muted">Solo se puede eliminar cuando la cuenta está en $0.00.</span>
    </div>`,
    bind(){
      const b = $('#del-cli');
      b.addEventListener('click',()=>{
        if(confirm('¿Eliminar al cliente "'+c.user+'"? Esta acción no se puede deshacer.')){
          db.users = db.users.filter(x=>x.user!==c.user); save(); toast('Cliente eliminado'); location.hash = '#/admin';
        }
      });
    }
  };
};

/* ---------- router ---------- */
const CLIENT_PAGES = ['resumen','transferir','depositar','movimientos','tarjetas'];
const PUBLIC_PAGES = ['inicio','login','registro'];

function render(){
  let h = location.hash.replace(/^#\/?/,'') || 'inicio';
  let [page, arg] = h.split('/');

  if(page==='salir'){ db.session=null; save(); location.hash='#/inicio'; return; }

  const u = me();
  if(CLIENT_PAGES.includes(page)){
    if(!u) { location.hash='#/login'; return; }
    if(u.role==='admin'){ location.hash='#/admin'; return; }
  } else if(page==='admin'){
    if(!u || u.role!=='admin'){ modoAdmin = true; location.hash='#/login'; return; }
    if(arg) page = 'detalle';
  } else if(!PUBLIC_PAGES.includes(page)){
    location.hash='#/inicio'; return;
  } else if(u && (page==='login' || page==='registro')){
    location.hash = u.role==='admin' ? '#/admin' : '#/resumen'; return;
  }

  const v = views[page](u, arg);
  if(v.redirect){ location.hash = v.redirect; return; }

  document.body.className = v.bodyClass || '';
  $('#app').innerHTML = v.nav + '<main>' + v.html + '</main>' + FOOT;
  // la página de login usa su propio diseño sin <main> con padding
  if(v.bind) v.bind(u);

  $('#reset')?.addEventListener('click', e=>{
    e.preventDefault();
    if(confirm('¿Reiniciar todos los datos de demostración?')){ db = SEED(); save(); location.hash='#/inicio'; render(); toast('Datos reiniciados'); }
  });
  // enlaces que bajan a una sección de la página de inicio
  $$('[data-go]').forEach(a=>a.addEventListener('click', e=>{
    const t = document.getElementById(a.dataset.go);
    if(t && (location.hash===''||location.hash==='#/inicio')){ e.preventDefault(); t.scrollIntoView({behavior:'smooth'}); }
    else setTimeout(()=>document.getElementById(a.dataset.go)?.scrollIntoView({behavior:'smooth'}),50);
  }));
  window.scrollTo(0,0);
}

window.addEventListener('hashchange', render);
render();
</script>
</body>
</html>
