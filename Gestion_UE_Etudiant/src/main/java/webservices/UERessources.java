package webservices;

import entities.UniteEnseignement;
import metiers.UniteEnseignementBusiness;

import javax.ws.rs.*;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

public class UERessources
{
    UniteEnseignementBusiness helper = new UniteEnseignementBusiness();
    @Path("/liste")
    @GET
    @Produces (MediaType.APPLICATION_JSON)
    public  Response liste()
    {
        return Response.status(200).entity(
                helper.getListeUE()
        ).build();
    }


    @Path("/ajout")
    @POST
    @Consumes(MediaType.APPLICATION_JSON)
    @Produces(MediaType.TEXT_PLAIN)
    public Response ajout(UniteEnseignement ue)
    {
        if(helper.addUniteEnseignement(ue))
            return Response.status(201).entity("Added succesfully").build();
        else
            return Response.status(409).entity("Already exists!").build();
    }
}

//getALLUES
@Path(/"list")
@GET
@Produces(MediaType.APPLICATION_JSON)
//getAllUEs
public Response getAllUe(){
    return Response
            .status(200)
            .entity(this.helper.getListeUE())
            .build();
}

//add object
public Response addUe(UniteEnseignement ue){
    if(this.helper.addUniteEnseignement(ue)){
        return Response.status(201)
                .entity("Added succesfully")
                .build();
    }
    return Response
            .status(409)
            .entity("already exist")
            .build();
}
// delete
public  Response deleteUE(int code){
    if(this.helper.deleteUniteEnseignement(code)){
        return Response.status(200).entity("Deleted successfully").build();

    } return Response
            .sataus(200)
            .entity("deleted done :D")
            .build();

} return Response
public Response search(@QueryParam(value= "s") int semestre){
    return Response
            .status(200)
            .entity(this.helper.getUEBysemester(semestre))
            .build();
}
