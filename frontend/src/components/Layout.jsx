
import { useNavigate } from 'react-router-dom'
import './Layout.css'

function Layout({ children }) {
    const navigate = useNavigate()

    async function handleLogout() {
        try {
            const xsrfCookie = document.cookie
                .split('; ')
                .find(cookie => cookie.startsWith('XSRF-TOKEN='))

            const xsrfToken = xsrfCookie
                ? decodeURIComponent(xsrfCookie.split('=').slice(1).join('='))
                : ''

            const response = await fetch('http://localhost:8000/api/logout', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Accept': 'application/json',
                    'X-XSRF-TOKEN': xsrfToken
                }
            })

            if (!response.ok) {
                const data = await response.json()
                console.log('Status:', response.status)
                console.log('Response:', data)

                throw new Error(data.message || `HTTP ${response.status}`)
            }

            navigate('/login')

        } catch (error) {
            console.error('Logout error:', error)
            alert(error.message)
        }
    }

    return (
        <div className="app-layout">

            {/* Sidebar */}
            <aside className="sidebar">
                <div className="brand">
                    <i className="bi bi-headset"></i>
                    <span>Helpdesk</span>
                </div>

                <div className="sidebar-label">MENU</div>

                <nav className="sidebar-nav">
                    <a href="#" className="nav-item active">
                        <i className="bi bi-grid"></i>
                        Dashboard
                    </a>

                    <a href="#" className="nav-item">
                        <i className="bi bi-ticket-detailed"></i>
                        All Tickets
                    </a>

                    <a href="#" className="nav-item">
                        <i className="bi bi-plus-circle"></i>
                        Create Ticket
                    </a>

                    <a href="#" className="nav-item">
                        <i className="bi bi-people"></i>
                        Users
                    </a>

                    <div className="sidebar-label">SYSTEM</div>

                    <a href="#" className="nav-item">
                        <i className="bi bi-gear"></i>
                        Settings
                    </a>
                </nav>

                <div className="sidebar-footer">
                    <div className="avatar">A</div>

                    <div>
                        <strong>Administrator</strong>
                        <small>Admin Account</small>
                    </div>

                    <button
                        type="button"
                        className="icon-button ms-auto"
                        onClick={handleLogout}
                        title="Logout"
                    >
                        <i className="bi bi-box-arrow-right"></i>
                    </button>
                </div>
            </aside>

            {/* Main area */}
            <main className="main-area">

                {/* Top navbar */}
                <header className="topbar">
                    <div>
                        <span className="breadcrumb-text">
                            Workspace / Dashboard
                        </span>
                    </div>

                    <div className="topbar-right">
                        <button className="icon-button">
                            <i className="bi bi-bell"></i>
                        </button>

                        <div className="topbar-profile">
                            <div className="avatar">A</div>
                            <span>Admin</span>
                        </div>
                    </div>
                </header>

                {children}

            </main>
        </div>
    )
}

export default Layout
