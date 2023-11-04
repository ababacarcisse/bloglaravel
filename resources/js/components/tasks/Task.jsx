/*
Ce code est une composante React qui affiche une liste de tâches paginées avec des liens de pagination.
 Elle effectue des requêtes API pour récupérer les tâches en fonction de la page actuelle, et elle permet de passer 
 à la page précédente ou suivante en cliquant sur les liens de pagination. La fonction checkIfIsDone permet 
 d'afficher l'état de chaque tâche,tandis que renderPaginationLinks génère les liens de pagination en fonction
  des données de la réponse de l'API.
*/

import { useEffect, useState } from "react";
import axios from 'axios';
import { Link } from "react-router-dom";

export default function Tasks() {
    // Utilisation de l'état pour stocker les tâches et la page actuelle
    const [tasks, setTasks] = useState([]);
    const [page, setPage] = useState(1);

    // Utilisation de useEffect pour exécuter fetchTasks lorsque la page change
    useEffect(() => {
        fetchTasks();
    }, [page]);

    // Fonction pour rendre les liens de pagination
    const renderPaginationLinks = () => {
        return (
            <ul className="pagination">
                {tasks.links?.map((link, index) => (
                    <li key={index} className="page-item">
                        <a
                            style={{ cursor: 'pointer' }}
                            className={`page-link ${link.active ? 'active' : ''}`}
                            onClick={() => fetchNextPrevTasks(link.url)}
                        >
                            {link.label.replace('&laquo;', '').replace('&raquo;', '')}
                        </a>
                    </li>
                ))}
            </ul>
        );
    }

    // Fonction pour effectuer une requête pour obtenir les tâches
    const fetchTasks = async () => {
        try {
            // Utilisation d'axios pour effectuer une requête GET avec la page actuelle
            const response = await axios.get(`/api/tasks?page=${page}`);
            // Mise à jour de l'état des tâches avec les données de la réponse
            setTasks(response.data);
        } catch (error) {
            console.log(`Erreur pour l'affichage des tâches ${error}`);
        }
    };

    // Fonction pour extraire la page à partir de l'URL du lien de pagination
    const fetchNextPrevTasks = (link) => {
        const url = new URL(link);
        // Mise à jour de la page avec la valeur de la page extraite de l'URL
        setPage(url.searchParams.get('page'));
    }

    // Fonction pour vérifier si une tâche est terminée ou en cours
    const checkIfIsDone = (done) => {
        return done ? (
            <span className="badge badge-success">
                Done
            </span>
        ) : (
            <span className="badge bg-danger">
                Processing...
            </span>
        );
    };

    return (
        <div className="container">
            <div className="row my-5">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-body">
                            <table className="table table-bordered table-striped table-hover">
                                <thead className="bg-primary text-white">
                                    <tr>
                                        <th>ID</th>
                                        <th>Titre</th>
                                        <th>Body</th>
                                        <th>Category</th>
                                        <th>Done</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {/* Utilisation de la liste des tâches pour générer des lignes de tableau */}
                                    {tasks.data?.map(task => (
                                        <tr key={task.id}>
                                            <td>{task.id}</td>
                                            <td>{task.title}</td>
                                            <td>{task.body}</td>
                                            <td>{task.category.name}</td>
                                            <td>
                                                {/* Utilisation de la fonction checkIfIsDone pour afficher l'état de la tâche */}
                                                {checkIfIsDone(task.done)}
                                            </td>
                                            <td>{task.created_at}</td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                            <div className="my-4 d-flex justify-content-between">
                                <div>
                                    {/* Affichage de la plage de tâches actuellement affichées et du nombre total de résultats */}
                                    Showing {tasks.from || 0} to {tasks.to || 0} from {tasks.total} results.
                                </div>
                                <div>
                                    {/* Rendu des liens de pagination */}
                                    {renderPaginationLinks()}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
