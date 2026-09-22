<?php
/**
 * TEXARA - central configuration.
 * Edit every text, number and contact detail of the site from this file.
 */

return [

    // ---------------------------------------------------------------
    // Brand & contact
    // ---------------------------------------------------------------
    'brand' => [
        'name'      => 'TEXARA',
        'tagline'   => 'Contract Manufacturing',
        'domain'    => 'texara.co',
        'url'       => 'https://texara.co',
        'email'     => 'hello@texara.co',
        'phone'     => '+57 300 000 0000',
        'whatsapp'  => '573000000000', // digits only, international format
        'address'   => 'Medellin, Antioquia, Colombia',
        'hours'     => 'Mon-Fri 7:00-17:00 (GMT-5, same hours as US Central)',
        'founded'   => 2009,
        'social'    => [
            'LinkedIn'  => '#',
            'Instagram' => '#',
        ],
    ],

    // Where the contact form is delivered
    'mail' => [
        'to'          => 'hello@texara.co',
        // Must be an address of THIS domain or shared hosting will drop the mail
        'from'        => 'no-reply@texara.co',
        'subject'     => 'New RFQ from texara.co',
        'log_csv'     => __DIR__ . '/storage/leads.csv',
    ],

    // ---------------------------------------------------------------
    // SEO
    // ---------------------------------------------------------------
    'seo' => [
        'title'       => 'TEXARA | Nearshore Contract Manufacturing in Colombia',
        'description' => 'TEXARA is a Colombian contract manufacturer (maquila) for US brands. Apparel, home goods, packaging and light assembly. 3-week sampling, audited plants, 4-hour flight from Miami.',
        'keywords'    => 'contract manufacturing Colombia, maquila Colombia, nearshoring, private label manufacturer, cut and sew Colombia, USA brands',
    ],

    // ---------------------------------------------------------------
    // Hero
    // ---------------------------------------------------------------
    'hero' => [
        'eyebrow'   => 'Nearshore manufacturing - Colombia to the USA',
        // {{ }} wraps the words painted in green
        'title'     => 'YOUR PRODUCT, {{BUILT CLOSER}} TO YOUR MARKET',
        'text'      => 'TEXARA is a full-service maquila in Colombia. We take your tech pack, sample it in three weeks and run production under your label - with US-hours communication and duty-free shipping under the trade agreement.',
        'cta_1'     => 'Request a quote',
        'cta_2'     => 'See capabilities',
        'ticker'    => [
            ['value' => '15', 'suffix' => '+', 'label' => 'Years manufacturing'],
            ['value' => '480', 'suffix' => 'K', 'label' => 'Units shipped / year'],
            ['value' => '21', 'suffix' => ' days', 'label' => 'Average sampling time'],
            ['value' => '0', 'suffix' => '%', 'label' => 'Import duty to the USA'],
        ],
    ],

    'marquee' => [
        'CUT & SEW', 'PRIVATE LABEL', 'LIGHT ASSEMBLY', 'PACKAGING',
        'QUALITY CONTROL', 'FULL PACKAGE', 'NEARSHORING', 'MADE IN COLOMBIA',
    ],

    // ---------------------------------------------------------------
    // Capabilities
    // ---------------------------------------------------------------
    'capabilities' => [
        'eyebrow' => 'What we make',
        'title'   => 'ONE FLOOR, {{FOUR PRODUCTION LINES}}',
        'text'    => 'We are a general maquila: if it can be cut, sewn, molded, filled or assembled by hand, it has a line here. Mixed runs are welcome - most clients start with one category and grow into two.',
        'items'   => [
            [
                'num'   => '01',
                'title' => 'Apparel & cut and sew',
                'text'  => 'Knit and woven garments, uniforms, activewear, bags and accessories. Pattern making, grading, marker, cutting, sewing, embroidery, screen and DTF printing, finishing and polybagging.',
                'tags'  => ['Tech pack to bulk', 'MOQ 300 units', 'In-house patternmaking'],
                'img'   => 'cap-apparel.jpg',
                'alt'   => 'Operator working at a sewing station on a garment production floor',
            ],
            [
                'num'   => '02',
                'title' => 'Home & textile goods',
                'text'  => 'Bedding, table linen, curtains, cushions, pet products and promotional textiles. Wide-format cutting, quilting, heavy-duty stitching and made-to-measure runs.',
                'tags'  => ['Wide format', 'Custom sizing', 'Retail-ready sets'],
                'img'   => 'cap-home.jpg',
                'alt'   => 'Stack of folded cotton home textiles in several colours',
            ],
            [
                'num'   => '03',
                'title' => 'Light assembly & kitting',
                'text'  => 'Sub-assembly, component fitting, labeling, relabeling, rework and multi-SKU kitting. Manual lines that scale up and down with your season without you hiring anyone.',
                'tags'  => ['Multi-SKU kits', 'Rework & rescue', 'Flexible headcount'],
                'img'   => 'cap-assembly.jpg',
                'alt'   => 'Manual assembly line with operators working at individual stations',
            ],
            [
                'num'   => '04',
                'title' => 'Packaging & fulfillment prep',
                'text'  => 'Primary and secondary packaging, hang tags, care labels, barcode compliance, Amazon FBA prep and export cartonization ready for your 3PL.',
                'tags'  => ['FBA prep', 'GS1 barcodes', 'Export cartons'],
                'img'   => 'cap-packaging.jpg',
                'alt'   => 'Worker handling flat cartons on a packaging line',
            ],
        ],
    ],

    // ---------------------------------------------------------------
    // Process
    // ---------------------------------------------------------------
    'process' => [
        'eyebrow' => 'How it runs',
        'title'   => 'FROM TECH PACK TO {{LOADED CONTAINER}}',
        'text'    => 'Six steps, one project manager, one weekly report. You always know which stage your order is in.',
        'steps'   => [
            ['num' => '01', 'title' => 'Brief & feasibility', 'text' => 'Send a tech pack, a sample or a sketch. Within 72 hours you get a target cost, MOQ and a realistic calendar - or an honest no.'],
            ['num' => '02', 'title' => 'Sourcing & costing', 'text' => 'We quote materials with our mills and trim suppliers, or work with nominated vendors. You approve the full bill of materials before anything moves.'],
            ['num' => '03', 'title' => 'Prototype & fit', 'text' => 'First proto in 10-14 days, fit sample and pre-production sample after your comments. Photos and measurement charts at every round.'],
            ['num' => '04', 'title' => 'Pilot run', 'text' => 'A short run on the real line with the real operators. Times, consumption and defects are measured before we commit the bulk.'],
            ['num' => '05', 'title' => 'Bulk production', 'text' => 'Dedicated modules, daily output tracking and inline QC. You get a Monday report with units finished, units left and any risk on the calendar.'],
            ['num' => '06', 'title' => 'QC, pack & ship', 'text' => 'AQL 2.5 final inspection, retail-ready packing and export documents. Air freight from Medellin lands in Miami the next day; ocean in 7-10 days.'],
        ],
    ],

    // ---------------------------------------------------------------
    // Why Colombia
    // ---------------------------------------------------------------
    'why' => [
        'eyebrow' => 'Why nearshore',
        'title'   => 'ASIA PRICING IS {{ONLY HALF THE INVOICE}}',
        'text'    => 'Count freight, duty, 90 days of cash tied up on the water and the minimums you did not want. Colombia changes that arithmetic.',
        'cards'   => [
            ['k' => '1-2 days', 'v' => 'Air freight to Miami', 't' => 'A four-hour flight instead of a five-week crossing. Reorders land before your season ends.'],
            ['k' => '0% duty',  'v' => 'US-Colombia trade agreement', 't' => 'Qualifying goods enter the United States duty free. That is margin back in your pocket, not in a tariff line.'],
            ['k' => '300 units','v' => 'Realistic minimums', 't' => 'Test a style without printing 5,000 pieces. Scale the ones that sell, kill the ones that do not.'],
            ['k' => 'GMT-5',    'v' => 'Your working hours', 't' => 'Same time zone as Chicago. Questions get answered the same day, not at 3 a.m. in an email chain.'],
        ],
        'compare' => [
            'title' => 'Landed reality check',
            'rows'  => [
                ['label' => 'Sampling round',      'near' => '10-14 days',  'far' => '30-45 days'],
                ['label' => 'Bulk lead time',      'near' => '25-40 days',  'far' => '60-90 days'],
                ['label' => 'Transit to US East',  'near' => '1-10 days',   'far' => '30-45 days'],
                ['label' => 'Import duty',         'near' => '0%',          'far' => '8-32%'],
                ['label' => 'Typical MOQ',         'near' => '300 units',   'far' => '1,000-3,000'],
                ['label' => 'Visit the factory',   'near' => '4h flight',   'far' => '20h+ flight'],
            ],
            'near_label' => 'TEXARA / Colombia',
            'far_label'  => 'Typical Asia sourcing',
        ],
    ],

    // ---------------------------------------------------------------
    // Estimator (interactive)
    // ---------------------------------------------------------------
    'estimator' => [
        'eyebrow' => 'Plan your run',
        'title'   => 'BUILD YOUR {{PRODUCTION RUN}}',
        'text'    => 'Move the sliders for an instant read on minimums, lead time and sampling. Indicative only - the real number comes back within 72 hours of your tech pack.',
        'categories' => [
            ['id' => 'apparel',   'label' => 'Apparel / cut & sew', 'moq' => 300, 'base' => 28, 'sample' => 14],
            ['id' => 'home',      'label' => 'Home & textile',      'moq' => 250, 'base' => 25, 'sample' => 12],
            ['id' => 'assembly',  'label' => 'Light assembly',      'moq' => 500, 'base' => 18, 'sample' => 8],
            ['id' => 'packaging', 'label' => 'Packaging & prep',    'moq' => 1000,'base' => 12, 'sample' => 6],
        ],
    ],

    // ---------------------------------------------------------------
    // Standards
    // ---------------------------------------------------------------
    'standards' => [
        'eyebrow' => 'Standards',
        'title'   => 'AUDIT US BEFORE YOU {{TRUST US}}',
        'text'    => 'Every claim on this page is something you can verify on a video call or a walk through the plant.',
        'items'   => [
            ['title' => 'AQL 2.5 inspection', 'text' => 'Inline checks every two hours and a final random inspection against your approved sample. Report with photos before the goods leave.'],
            ['title' => 'Social compliance',  'text' => 'Legal contracts, full social security, no subcontracting without your written approval. Open to BSCI, WRAP or your own third-party audit.'],
            ['title' => 'Material traceability', 'text' => 'Every roll, trim and component logged by lot. If a defect shows up in the field we can tell you exactly which batch it came from.'],
            ['title' => 'Your IP stays yours', 'text' => 'NDA signed before the first file. Patterns, molds and artwork are yours and never run for another client.'],
        ],
    ],

    // ---------------------------------------------------------------
    // FAQ
    // ---------------------------------------------------------------
    'faq' => [
        'eyebrow' => 'Questions',
        'title'   => 'THE THINGS BUYERS {{ALWAYS ASK}}',
        'items'   => [
            ['q' => 'What is the real minimum order?', 'a' => 'Three hundred units per style for apparel, two hundred and fifty for home textiles, five hundred for assembly. Split across sizes and up to four colorways at no extra charge. Below that we can still quote, but the unit price stops being competitive and we will tell you so.'],
            ['q' => 'How much does sampling cost?', 'a' => 'A first prototype runs between 80 and 250 USD depending on complexity, and it is credited back against your first bulk order. Development of patterns and markers is included when the order is confirmed.'],
            ['q' => 'What are the payment terms?', 'a' => 'Fifty percent to open the order, fifty against inspection report before shipping. From the third order onward we open 30-day terms. Wire transfer in USD to a US account.'],
            ['q' => 'Do you handle shipping and customs?', 'a' => 'Yes. We quote EXW, FOB or DDP to your door. Our broker prepares the certificate of origin so qualifying goods clear duty free under the US-Colombia trade agreement.'],
            ['q' => 'Can we visit the plant?', 'a' => 'Please do. Medellin is a four-hour flight from Miami and we host client visits every month. If you cannot travel we will walk the line on a live video call any working day.'],
            ['q' => 'What if the quality is wrong?', 'a' => 'Nothing ships without an inspection report you have seen. If units fail after that, we rework or replace them at our cost - that clause is in every contract we sign.'],
        ],
    ],

    // ---------------------------------------------------------------
    // Contact
    // ---------------------------------------------------------------
    'contact' => [
        'eyebrow' => 'Start here',
        'title'   => 'TELL US WHAT YOU {{NEED BUILT}}',
        'text'    => 'Send the brief and you get a real answer in 72 hours: target cost, minimum, calendar - or an honest no if it is not a fit for our floor.',
        'volumes' => ['Under 500 units', '500 - 2,000 units', '2,000 - 10,000 units', 'Over 10,000 units', 'Not sure yet'],
    ],

    'legal' => [
        'company'  => 'TEXARA S.A.S.',
        'nit'      => 'NIT 900.000.000-0',
        'updated'  => 'September 2026',
    ],
];
