<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Coursio is a curated library of free technology and business courses with clear certificate information.">
<title>Coursio — Learn without the guesswork</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
:root{color-scheme:light}html{scroll-behavior:smooth}body{background:#f7f8f6;color:#101828}
.glass{background:rgba(255,255,255,.88);backdrop-filter:blur(16px)}.card{transition:transform .18s,box-shadow .18s}.card:hover{transform:translateY(-3px);box-shadow:0 18px 48px #10182812}
</style>
</head>
<body class="font-sans antialiased">
<header class="sticky top-0 z-20 border-b border-slate-200 glass"><nav class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4">
<a href="/" class="flex items-center gap-3"><span class="grid h-10 w-10 place-items-center rounded-2xl bg-slate-950 text-emerald-300 text-lg font-black">co.</span><span><b class="block tracking-tight">Coursio</b><small class="text-slate-500">A better way to learn</small></span></a>
<div class="hidden gap-6 text-sm font-semibold sm:flex"><a href="#library" class="text-slate-600 hover:text-slate-950">Explore</a><a href="#how" class="text-slate-600 hover:text-slate-950">How it works</a><a href="#note" class="text-slate-600 hover:text-slate-950">Credential guide</a></div>
<a href="#library" class="rounded-full bg-slate-950 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700">Find a course ↗</a></nav></header>
<section class="relative overflow-hidden bg-slate-950 text-white"><div class="absolute -right-20 -top-32 h-96 w-96 rounded-full bg-emerald-400/20 blur-3xl"></div><div class="relative mx-auto grid max-w-7xl gap-12 px-5 py-16 md:grid-cols-[1.2fr_.8fr] md:items-center md:py-24">
<div><span class="inline-flex rounded-full border border-white/15 bg-white/5 px-3 py-1.5 text-xs font-semibold text-emerald-200">CURATED LEARNING · CLEAR CREDENTIALS</span><h1 class="mt-6 max-w-3xl text-5xl font-black leading-[1.04] tracking-[-.045em] sm:text-7xl">Your next skill.<br><span class="text-emerald-300">No price tag.</span></h1><p class="mt-6 max-w-xl text-lg leading-8 text-slate-300">Explore technology and business learning resources without getting caught out by certificate fees. Learn first. Choose wisely.</p><a href="#library" class="mt-8 inline-flex rounded-full bg-emerald-300 px-6 py-3 font-bold text-slate-950 hover:bg-emerald-200">Explore the library <span class="ml-3">↓</span></a></div>
<div class="rounded-3xl border border-white/10 bg-white/[.06] p-6 backdrop-blur"><div class="text-sm font-semibold text-emerald-200">A smarter starting point</div><div class="mt-5 grid grid-cols-2 gap-3"><div class="rounded-2xl bg-white/10 p-4"><div class="text-3xl font-black">{{ $total }}</div><div class="mt-1 text-sm text-slate-300">Curated resources</div></div><div class="rounded-2xl bg-white/10 p-4"><div class="text-3xl font-black">{{ $categories->count() }}</div><div class="mt-1 text-sm text-slate-300">Learning topics</div></div><div class="col-span-2 rounded-2xl border border-emerald-300/20 bg-emerald-300/10 p-4"><div class="font-bold">Free to learn ≠ free certificate</div><p class="mt-1 text-sm leading-6 text-slate-300">Coursio makes credential conditions visible so you can plan before enrolling.</p></div></div></div>
</div></section>
<main id="library" class="mx-auto max-w-7xl px-5 py-14">
<div class="flex flex-col justify-between gap-4 md:flex-row md:items-end"><div><p class="text-sm font-bold uppercase tracking-[.18em] text-emerald-700">The directory</p><h2 class="mt-2 text-3xl font-black tracking-tight sm:text-4xl">Find your next course</h2><p class="mt-2 text-slate-600">Search official resources and check the credential terms.</p></div><div class="text-sm text-slate-500"><b class="text-slate-950">{{ $resources->count() }}</b> results</div></div>
<form action="/" method="GET" class="mt-8 grid gap-3 rounded-3xl border border-slate-200 bg-white p-4 shadow-sm md:grid-cols-[1fr_190px_200px_auto]">
<label class="flex items-center gap-3 rounded-2xl bg-slate-50 px-4"><span class="text-slate-400">⌕</span><input name="q" value="{{ $q }}" placeholder="Search skills, courses, providers…" class="w-full bg-transparent py-3 text-sm outline-none"></label>
<select name="category" class="rounded-2xl bg-slate-50 px-4 py-3 text-sm outline-none"><option>All topics</option>@foreach($categories as $c)<option value="{{ $c }}" @selected($category===$c)>{{ $c }}</option>@endforeach</select>
<select name="credential" class="rounded-2xl bg-slate-50 px-4 py-3 text-sm outline-none"><option>All credentials</option>@foreach(['Free certificates','Free badges','No certificate','Paid certificate'] as $c)<option @selected($credential===$c)>{{ $c }}</option>@endforeach</select>
<button class="rounded-2xl bg-slate-950 px-6 py-3 text-sm font-bold text-white hover:bg-emerald-700">Search</button>
</form>
<div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
@forelse($resources as $item)
<article class="card flex flex-col rounded-3xl border border-slate-200 bg-white p-6">
<div class="flex items-start justify-between gap-3"><span class="rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-800">{{ $item['category'] }}</span><span class="text-xs text-slate-400">{{ $item['level'] }}</span></div>
<h3 class="mt-5 text-xl font-extrabold tracking-tight">{{ $item['title'] }}</h3><p class="mt-1 text-sm font-semibold text-slate-500">{{ $item['provider'] }}</p>
<p class="mt-4 flex-1 text-sm leading-6 text-slate-600">{{ $item['description'] }}</p>
<div class="mt-5 rounded-2xl bg-slate-50 p-3"><div class="text-[10px] font-bold uppercase tracking-[.15em] text-slate-400">Credential</div><div class="mt-1 text-sm font-bold text-slate-800">{{ $item['type'] }}</div></div>
<div class="mt-5 flex items-center justify-between gap-3"><span class="text-xs text-slate-400">{{ $item['tags'] }}</span><a href="{{ $item['url'] }}" target="_blank" rel="noopener noreferrer" class="shrink-0 rounded-full bg-slate-950 px-4 py-2.5 text-sm font-bold text-white hover:bg-emerald-700">Visit ↗</a></div>
</article>
@empty
<div class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center"><h3 class="text-xl font-bold">No matches yet</h3><p class="mt-2 text-slate-500">Try another keyword or clear one of the filters.</p><a href="/" class="mt-5 inline-block font-bold text-emerald-700">Clear filters ↗</a></div>
@endforelse
</div>
<section id="how" class="mt-16 grid gap-5 md:grid-cols-3"><div class="rounded-3xl bg-white p-6 border border-slate-200"><div class="text-sm font-bold text-emerald-700">01 / SEARCH</div><h3 class="mt-3 text-lg font-extrabold">Find the skill</h3><p class="mt-2 text-sm leading-6 text-slate-600">Search by topic, provider, tool, or learning goal.</p></div><div class="rounded-3xl bg-white p-6 border border-slate-200"><div class="text-sm font-bold text-emerald-700">02 / CHECK</div><h3 class="mt-3 text-lg font-extrabold">Read the fine print</h3><p class="mt-2 text-sm leading-6 text-slate-600">Distinguish free learning, free badges, and paid certification exams.</p></div><div class="rounded-3xl bg-white p-6 border border-slate-200"><div class="text-sm font-bold text-emerald-700">03 / LEARN</div><h3 class="mt-3 text-lg font-extrabold">Start at the source</h3><p class="mt-2 text-sm leading-6 text-slate-600">Use the official provider link to confirm current terms and enroll.</p></div></section>
<section id="note" class="mt-8 rounded-3xl bg-emerald-50 p-6 sm:p-8"><h3 class="text-lg font-extrabold">A quick note on certificates</h3><p class="mt-2 max-w-4xl text-sm leading-6 text-slate-700">Course availability and credential policies can change. Some platforms offer free study but charge for exams, and some credentials are available only for selected learning paths. Always verify the official provider page before you commit time or money.</p></section>
</main>
<footer class="mt-8 border-t border-slate-200 bg-white"><div class="mx-auto flex max-w-7xl flex-col gap-2 px-5 py-8 text-sm text-slate-500 sm:flex-row sm:justify-between"><p>© {{ date('Y') }} Coursio · Built for curious minds.</p><p>Learn with clarity. Verify credentials at the source.</p></div></footer>
</body></html>