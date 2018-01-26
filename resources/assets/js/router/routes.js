import Welcome from '../components/Welcome'
import Difficulty from '../components/Difficulty'
import Game from '../components/Game'
import Leaderboard from '../components/Leaderboard'
import NotFound from '../components/NotFound'

const routes = [
    {
        path: '/',
        name: 'welcome',
        component: Welcome
    },
    {
        path: '/difficulty',
        name: 'difficulty',
        component: Difficulty
    },
    {
        path: '/game',
        name: 'game',
        component: Game
    },
    {
        path: '/leaderboard',
        name: 'leaderboard',
        component: Leaderboard
    },
    {
        path: '*',
        component: NotFound
    }

]

export default routes
