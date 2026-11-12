
import { useEffect, useState } from 'react'

function Dashboard() {
    const [dashboard, setDashboard] = useState(null)
    const [loading, setLoading] = useState(true)
    const [error, setError] = useState(null)

    useEffect(() => {
        fetch('http://localhost:8000/api/dashboard', {
            credentials: 'include',
            headers: {
                'Accept': 'application/json'
            }
        })
            .then(response => {
                if (!response.ok) throw new Error('Failed to fetch dashboard')
                return response.json()
            })
            .then(data => setDashboard(data))
            .catch(error => setError(error.message))
            .finally(() => setLoading(false))
    }, [])

    if (loading) return <div className="container-fluid py-4">Loading dashboard...</div>
    if (error) return <div className="container-fluid py-4 text-danger">{error}</div>

    const priorityColors = {
        Low: 'success',
        Medium: 'info',
        High: 'warning',
        Urgent: 'danger'
    }

    const statusColors = {
        open: 'secondary',
        assigned: 'info',
        closed: 'dark'
    }

    return (
        <div className="container-fluid py-4">

            {/* Dashboard Header */}
            <div className="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 className="fw-bold mb-1">Dashboard</h4>
                    <p className="text-muted small mb-0">
                        Overview of helpdesk activities and ticket statistics.
                    </p>
                </div>

                <div className="text-muted small">
                    <i className="bi bi-calendar3 me-1"></i>
                    {dashboard.today_date}
                </div>
            </div>

            {/* Total Tickets */}
            <div className="row g-3 mb-4">

                <div className="col-12 col-sm-6 col-xl">
                    <div className="card border-0 shadow-sm h-100">
                        <div className="card-body">
                            <div className="d-flex justify-content-between align-items-center">
                                <span className="text-muted small fw-semibold">Total Tickets</span>
                                <i className="bi bi-ticket-perforated fs-4 text-primary"></i>
                            </div>
                            <h3 className="fw-bold mt-3 mb-1">{dashboard.total_ticket}</h3>
                            <small className="text-muted">All tickets submitted</small>
                        </div>
                    </div>
                </div>

                {dashboard.status.map(status => (
                    <div className="col-12 col-sm-6 col-xl" key={status.name}>
                        <div className="card border-0 shadow-sm h-100">
                            <div className="card-body">
                                <div className="d-flex justify-content-between align-items-center">
                                    <span className="text-muted small fw-semibold">
                                        {status.name}
                                    </span>

                                    <i className={`bi ${status.icon} fs-4 text-${status.color}`}></i>
                                </div>

                                <h3 className="fw-bold mt-3 mb-1">{status.count}</h3>
                                <small className="text-muted">Tickets</small>
                            </div>
                        </div>
                    </div>
                ))}

            </div>

            {/* Statistics */}
            <div className="row g-3 mb-4">

                {/* Priority Statistics */}
                <div className="col-12 col-lg-6">
                    <div className="card border-0 shadow-sm h-100">
                        <div className="card-body p-4">
                            <h6 className="fw-bold mb-4">Tickets by Priority</h6>

                            {dashboard.priority.map(priority => (
                                <div className="mb-4" key={priority.name}>

                                    <div className="d-flex justify-content-between mb-2">
                                        <span className="small fw-semibold">
                                            {priority.name}
                                        </span>

                                        <span className="small text-muted">
                                            {priority.count} tickets
                                        </span>
                                    </div>

                                    <div className="progress" style={{ height: '8px' }}>
                                        <div
                                            className={`progress-bar bg-${priorityColors[priority.name]}`}
                                            style={{
                                                width: `${dashboard.total_ticket > 0
                                                    ? (priority.count / dashboard.total_ticket) * 100
                                                    : 0}%`
                                            }}
                                        ></div>
                                    </div>

                                </div>
                            ))}

                        </div>
                    </div>
                </div>

                {/* Resolution Statistics */}
                <div className="col-12 col-lg-6">
                    <div className="card border-0 shadow-sm h-100">
                        <div className="card-body p-4">
                            <h6 className="fw-bold mb-4">Resolution Statistics</h6>

                            <div className="row g-3">

                                <div className="col-6">
                                    <div className="bg-light rounded p-3">
                                        <small className="text-muted">Resolved This Month</small>
                                        <h3 className="fw-bold text-success mt-2 mb-0">
                                            {dashboard.resolution.resolved}
                                        </h3>
                                    </div>
                                </div>

                                <div className="col-6">
                                    <div className="bg-light rounded p-3">
                                        <small className="text-muted">Opened This Month</small>
                                        <h3 className="fw-bold mt-2 mb-0">
                                            {dashboard.resolution.open}
                                        </h3>
                                    </div>
                                </div>

                                <div className="col-6">
                                    <div className="bg-light rounded p-3">
                                        <small className="text-muted">Average Resolution Time</small>
                                        <h4 className="fw-bold mt-2 mb-0">
                                            {dashboard.resolution.average_time}
                                        </h4>
                                    </div>
                                </div>

                                <div className="col-6">
                                    <div className="bg-light rounded p-3">
                                        <small className="text-muted">Resolution Rate</small>
                                        <h4 className="fw-bold text-primary mt-2 mb-0">
                                            {dashboard.resolution.rate}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {/* Recently Submitted Tickets */}
            <div className="card border-0 shadow-sm">

                <div className="card-header bg-white border-0 p-4">
                    <div className="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 className="fw-bold mb-1">Recently Submitted Tickets</h6>
                            <small className="text-muted">Latest ticket submissions</small>
                        </div>

                        <a href="/tickets" className="btn btn-sm btn-outline-primary">
                            View All
                            <i className="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div className="card-body p-0">
                    <div className="table-responsive">
                        <table className="table table-hover align-middle mb-0">

                            <thead className="table-light">
                                <tr>
                                    <th className="px-4">Ticket Number</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th className="pe-4">Submitted</th>
                                </tr>
                            </thead>

                            <tbody>
                                {dashboard.recent.map(ticket => (
                                    <tr key={ticket.id}>
                                        <td className="px-4 fw-semibold text-primary">
                                            {ticket.ticket_number}
                                        </td>

                                        <td>{ticket.title}</td>

                                        <td>{ticket.category?.name ?? '-'}</td>

                                        <td>
                                            <span className={`badge bg-${priorityColors[ticket.priority]}-subtle text-${priorityColors[ticket.priority]}`}>
                                                {ticket.priority}
                                            </span>
                                        </td>

                                        <td>
                                            <span className={`badge bg-${statusColors[ticket.status]}-subtle text-${statusColors[ticket.status]}`}>
                                                {ticket.status}
                                            </span>
                                        </td>

                                        <td className="pe-4 text-muted small">
                                            {new Date(ticket.created_at).toLocaleDateString('en-GB', {
                                                day: '2-digit',
                                                month: 'long',
                                                year: 'numeric'
                                            })}
                                        </td>
                                    </tr>
                                ))}

                                {dashboard.recent.length === 0 && (
                                    <tr>
                                        <td colSpan="6" className="text-center py-4 text-muted">
                                            No recent tickets.
                                        </td>
                                    </tr>
                                )}

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    )
}

export default Dashboard
