package webservices;

import entities.UniteEnseignement;
import metiers.UniteEnseignementBusiness;

import javax.ws.rs.*;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
import java.util.List;

@Path("/ue") // racine des ressources UE
public class UERessources {

    private UniteEnseignementBusiness helper = new UniteEnseignementBusiness();

    // --- GET: Liste de toutes les UE ---
    @GET
    @Path("/liste")
    @Produces(MediaType.APPLICATION_JSON)
    public Response getAllUEs() {
        List<UniteEnseignement> ues = helper.getListeUE();
        return Response.status(200).entity(ues).build();
    }

    // --- POST: Ajouter une nouvelle UE ---
    @POST
    @Path("/ajout")
    @Consumes(MediaType.APPLICATION_JSON)
    @Produces(MediaType.TEXT_PLAIN)
    public Response addUE(UniteEnseignement ue) {
        if (helper.addUniteEnseignement(ue)) {
            return Response.status(201).entity("Added successfully").build();
        }
        return Response.status(409).entity("Already exists!").build();
    }

    // --- DELETE: Supprimer une UE par code ---
    @DELETE
    @Path("/delete/{code}")
    @Produces(MediaType.TEXT_PLAIN)
    public Response deleteUE(@PathParam("code") int code) {
        if (helper.deleteUniteEnseignement(code)) {
            return Response.status(200).entity("Deleted successfully").build();
        }
        return Response.status(404).entity("UE not found").build();
    }

    // --- GET: Rechercher des UE par semestre ---
    @GET
    @Path("/search")
    @Produces(MediaType.APPLICATION_JSON)
    public Response searchBySemester(@QueryParam("s") int semestre) {
        List<UniteEnseignement> ues = helper.getUEBySemester(semestre);

        return Response.status(200).entity(ues).build();
    }
}
