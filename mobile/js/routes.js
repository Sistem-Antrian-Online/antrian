var routes = [
  { path: '/', componentUrl: 'halaman/home.html' },
  {
    path: '/detailantrian/', componentUrl: 'halaman/detail_antrian.html', options: {
      transition: 'f7-circle',
    },
  },
  { path: '(.*)', Url: 'pages/404.html' },
]