import React, { useState, useEffect } from "react";
import axios from "axios";
import { Button, Table } from "react-bootstrap";
import { Link } from "react-router-dom";

const ProductList = () => {
  const [dataArticle, setArticle] = useState([]);

  useEffect(() => {
    getArticle();
  }, []);

  const getArticle = async () => {
    try {
      const urlApi = "http://127.0.0.1:8000/api/articles";
      let articles = await axios.get(urlApi);
      articles = articles.data.data;

      setArticle(articles);
    } catch (error) {
      console.log(error);
    }
  };

  const deleteArticle = async (id) => {
    const urlApi = "http://127.0.0.1:8000/api/articles/" + id;
    await axios.delete(urlApi);
    getArticle();
  };

  return (
    <div className="mt-5">
      <h1 className="text-center">Data Article</h1>

      <div className="d-flex justify-content-end mt-2 mb-3">
        <Link to="add">
          <Button variant="primary">Tambah Data</Button>
        </Link>
      </div>

      <Table striped bordered hover>
        <thead>
          <tr className="text-center">
            <th>No</th>
            <th>Title</th>
            <th>Content</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody className="text-center">
          {dataArticle.map((row, index) => (
            <tr key={row.id}>
              <td>{index + 1}</td>

              <td>{row.title}</td>

              <td>{row.content}</td>

              <td>
                <Link to={`edit/${row.id}`}>
                  <Button variant="success">Ubah</Button>
                </Link>{" "}
                <Button variant="danger" onClick={() => deleteArticle(row.id)}>
                  Hapus
                </Button>
              </td>
            </tr>
          ))}
        </tbody>
      </Table>
    </div>
  );
};

export default ProductList;
