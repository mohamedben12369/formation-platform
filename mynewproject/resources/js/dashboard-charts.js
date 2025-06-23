// Importation de Chart.js
import Chart from 'chart.js/auto';

// Configuration générale des graphiques
const chartConfig = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            position: 'bottom',
            labels: {
                color: '#9899ac'
            }
        }
    }
};

// Graphique des compétences
export function initCompetencesChart(data) {
    const ctx = document.getElementById('competencesChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.values,
                backgroundColor: ['#009ef7', '#50cd89', '#ffc700'],
                borderWidth: 0
            }]
        },
        options: chartConfig
    });
}

// Graphique des diplômes
export function initDiplomesChart(data) {
    const ctx = document.getElementById('diplomesChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Diplômes par type',
                data: data.values,
                backgroundColor: '#7239ea',
                borderRadius: 6
            }]
        },
        options: {
            ...chartConfig,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#9899ac'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#9899ac'
                    }
                }
            }
        }
    });
}

// Graphique des expériences
export function initExperiencesChart(data) {
    const ctx = document.getElementById('experiencesChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Expériences par année',
                data: data.values,
                borderColor: '#ffc700',
                tension: 0.4,
                fill: true,
                backgroundColor: 'rgba(255, 199, 0, 0.1)'
            }]
        },
        options: {
            ...chartConfig,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#9899ac'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#9899ac'
                    }
                }
            }
        }
    });
}
