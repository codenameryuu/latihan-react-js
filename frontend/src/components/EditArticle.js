import React, { useState, useEffect } from "react";
import axios from "axios";
import { Button, Form } from "react-bootstrap";
import { useFormik } from "formik";
import { useNavigate, useParams } from "react-router-dom";

const EditArticle = () => {
  const [dataArticle, setArticle] = useState([]);
  const navigate = useNavigate();
  const { id } = useParams();

  useEffect(() => {
    getArticleById();
  }, []);

  const getArticleById = async () => {
    try {
      const urlApi = "http://127.0.0.1:8000/api/articles";
      let articles = await axios.get(urlApi);
      articles = articles.data.data;

      const article = articles.find((item) => item.id == id);

      setArticle(article);
    } catch (error) {
      console.log(error);
    }
  };

  const formik = useFormik({
    initialValues: {
      id: id ?? "",
      title: dataArticle?.title ?? "",
      content: dataArticle?.content ?? "",
    },
    onSubmit: (values) => {
      const id = values.id;
      const title = values.title;
      const content = values.content;

      const urlApi = "http://127.0.0.1:8000/api/articles/" + id;

      const payload = {
        article_id: id,
        title: title,
        content: content,
      };

      axios
        .post(urlApi, payload)
        .then((res) => {
          navigate("/");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    enableReinitialize: true,
  });

  return (
    <div className="mt-5">
      <h1 className="text-center">Data Article</h1>

      <div className="mt-2">
        <Form onSubmit={formik.handleSubmit}>
          <Form.Control
            type="hidden"
            name="id"
            id="id"
            value={formik.values.id}
            onChange={formik.handleChange}
          />

          <Form.Group className="mb-3">
            <Form.Label>Title</Form.Label>

            <Form.Control
              type="text"
              name="title"
              id="title"
              value={formik.values.title}
              onChange={formik.handleChange}
              placeholder="Masukan Judul Artikel"
            />
          </Form.Group>

          <Form.Group className="mb-3">
            <Form.Label>Content</Form.Label>

            <Form.Control
              type="text"
              name="content"
              id="content"
              value={formik.values.content}
              onChange={formik.handleChange}
              placeholder="Masukan Konten Artikel"
            />
          </Form.Group>

          <Button type="submit" variant="success w-100">
            Ubah Data
          </Button>
        </Form>
      </div>
    </div>
  );
};

export default EditArticle;
