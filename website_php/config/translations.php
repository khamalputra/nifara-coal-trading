<?php
/**
 * Central Translation Dictionary & Resolvers
 * PT. Nifara Coal Trading
 */

function getArticleTranslations(): array {
    return [
        'program-csr-pemberdayaan-masyarakat-sumatera-barat' => [
            'title' => 'CSR Program: Community Empowerment Commitment in West Sumatra Mining Hubs',
            'excerpt' => 'PT. Nifara Coal Trading delivers local economic empowerment programs and educational scholarships for talent in Payakumbuh.',
            'content' => '<p>As part of its long-term sustainability commitment and corporate social responsibility, PT. Nifara Coal Trading has launched an integrated CSR initiative focused on elevating community livelihoods surrounding mining logistics and operational corridors.</p><p>This program includes localized entrepreneurship mentoring, rural road infrastructure maintenance, and clean water access facilities to deliver positive, lasting economic contributions to surrounding communities.</p>'
        ],
        'efisiensi-rantai-pasok-maritim-lintas-sumatera' => [
            'title' => 'PT. Nifara Coal Trading Strengthens Maritime Supply Chain Efficiency Across Sumatra',
            'excerpt' => 'Optimization of barge loading cycles and jetty coordination systems successfully cuts shipping cycle time by up to 20%.',
            'content' => '<p>Through an integrated coordination system connecting mine pits, overland road hauling, and jetty loading terminals, the company has significantly improved turnaround times for 300-foot barges across Sumatra waterways.</p><p>This operational milestone guarantees that every thermal coal cargo delivery to domestic industrial clients and power generation facilities arrives reliably on schedule in compliance with commercial sales contracts.</p>'
        ],
        'penerapan-standar-transparansi-b2b-risk-based-oss' => [
            'title' => 'Implementation of Risk-Based OSS B2B Transparency Standards in Commodity Trading',
            'excerpt' => 'The company confirms comprehensive compliance with Minerba regulations and integrated reporting to build a secure trading ecosystem for partners.',
            'content' => '<p>Licensing transparency represents the single most vital pillar in high-value commodity trade. PT. Nifara Coal Trading ensures that all verified business legalities—including KBLI 46710, OSS-RBA NIB, and formal Ministry of Law corporate decrees—are openly accessible for review by industrial procurement and legal teams.</p>'
        ]
    ];
}

function getCategoryMap(): array {
    return [
        'Semua' => 'All',
        'CSR' => 'CSR',
        'Operasional' => 'Operations',
        'Operasional & Rantai Pasok' => 'Operations & Supply Chain',
        'Regulasi & Kepatuhan' => 'Regulation & Compliance',
        'Tata Kelola & Legalitas' => 'Governance & Legal',
        'Wawasan Pasar' => 'Market Insights',
        'Berita' => 'News'
    ];
}

function resolveArticleField(array $article, string $field): string {
    $slug = $article['slug'] ?? '';
    $translations = getArticleTranslations();
    
    if ($field === 'title') {
        if (!empty($article['title_en'])) return $article['title_en'];
        if (!empty($translations[$slug]['title'])) return $translations[$slug]['title'];
        return $article['title'] ?? '';
    }
    
    if ($field === 'excerpt') {
        if (!empty($article['excerpt_en'])) return $article['excerpt_en'];
        if (!empty($translations[$slug]['excerpt'])) return $translations[$slug]['excerpt'];
        return $article['excerpt'] ?? '';
    }
    
    if ($field === 'content') {
        if (!empty($article['content_en'])) return $article['content_en'];
        if (!empty($translations[$slug]['content'])) return $translations[$slug]['content'];
        return '';
    }
    
    if ($field === 'category') {
        $cat = $article['category'] ?? '';
        $map = getCategoryMap();
        return $map[$cat] ?? $cat;
    }
    
    return '';
}
