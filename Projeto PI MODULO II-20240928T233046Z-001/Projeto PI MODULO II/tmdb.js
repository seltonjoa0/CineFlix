const API_KEY = "fe153885e303bf5c8a55cdf39dad43ae";
const API_BASE = "https://api.themoviedb.org/3";

/*
- recomendados
- em alta
- Ação
- Comédia
- Terror
- Romance
- documentary
*/

const basicFetch = async () => {
  const req = await fetch(`${API_BASE}${endpoint}`);
  const json = await req.json();
  return json;
}
export default {
  getHomeList: async () => {
    return [
      {
        slug: 'trending',
        title: 'Recomendados para você',
        items: await basicFetch(` /trending/all/week?language=pt-BR&api_key=${API_KEY}`)
      },
      {
        slug: 'toprated',
        title: 'Em Alta',
        items: await basicFetch(` movie/top_rated?langague=pt-BR&api_key=${API_KEY}`)
      },
      {
        slug: 'toprated',
        title: 'Ação',
        items: await basicFetch(`discover/movie?with_genres=28&language=pt-BR&api_key=${API_KEY}`)
      },
      {
        slug: 'comedy',
        title: 'Comédia',
        items: await basicFetch(`discover/movie?with_genres=35&language=pt-BR&api_key=${API_KEY}`)
      },
      {
        slug: 'horror',
        title: 'Terror',
        items: await basicFetch(`discover/movie?with_genres=27&language=pt-BR&api_key=${API_KEY}`)
      },
      {
        slug: 'romance',
        title: 'Romanc',
        items: await basicFetch(`discover/movie?with_genres=10749&language=pt-BR&api_key=${API_KEY}`)
      },
      {
        slug: 'documentary',
        title: 'Docs',
        items: await basicFetch(`discover/movie?with_genres=99&language=pt-BR&api_key=${API_KEY}`)
      },
    ]
  }
}