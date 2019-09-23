const categories = [
    {
        title: 'Rode wijn',
        slug: 'rood',
        active: false,
    },
    {
        title: 'Witte wijn',
        slug: 'wit',
        active: true,
    },
    {
        title: 'Mousserende wijn',
        slug: 'mousserend',
        active: false,
    },
    {
        title: 'Rose wijn',
        slug: 'rose',
        active: false,
    },
    {
        title: 'Dessert wijn',
        slug: 'dessert',
        active: false,
    },
];

const prices = [
    { title: 'alle prijzen', slug: '*', active: true, },
    { title: '5 - 10', slug: '5-10', active: false},
    { title: '10 - 15', slug: '10-15', active: false},
    { title: '15 - 25', slug: '15-25', active: false},
    { title: '25+', slug: '25', active: false},
];

export default {
    categories,
    prices
};
