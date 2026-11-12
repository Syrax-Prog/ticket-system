
import './Layout.css'

function Layout({ children }) {
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

                {/* Page content will be inserted here */}
                {children}

            </main>
        </div>
    )
}

export default Layout
