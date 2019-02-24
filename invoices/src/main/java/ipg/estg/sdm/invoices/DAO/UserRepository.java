package ipg.estg.sdm.invoices.DAO;
import org.springframework.data.mongodb.repository.MongoRepository;

import ipg.estg.sdm.invoices.Entities.Users;

public interface UserRepository extends MongoRepository<Users, String>{

	Users findByEmail(String email);

}
